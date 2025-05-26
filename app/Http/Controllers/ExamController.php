<?php

namespace App\Http\Controllers;



use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
  public function store(Request $request){

      $request->validate([
          "subject_id"=>'required|exists:subjects,id',
          'hall_id'=>'required|exists:exam_halls,id',
          'max_students'=>'required|integer|min:1',
          'exam_type'=>'required|in:редовен,поправителен,ликвидация',
          'start_time'=>'required |date',
          'end_time'=>'required | date',
      ]);

      try {
      $hall = ExamHall::findOrFail($request->hall_id);

      // Parse the date-time strings from the form to Carbon instances
      $startTime = Carbon::parse($request->start_time);
      $endTime = Carbon::parse($request->end_time);

      // Calculate duration to validate it's a multiple of 45 minutes
      $duration = $endTime->diffInMinutes($startTime);
      if ($duration % 45 !== 0) {
          return back()->withErrors(['time' => 'Продължителността трябва да е кратна на 45 минути!']);
      }

      $openingTime=Carbon::parse($hall->opening_time)->setDate($startTime->year,$startTime->month,$startTime->day);
      $closingTime=Carbon::parse($hall->closing_time)->setDate($startTime->year,$startTime->month,$startTime->day);

      if($startTime->lt($openingTime)){
          return redirect()->back()->withErrors(['start_time'=>"Залата отваря в {$hall->opening_time}"]);
      }
      if($endTime->gt($closingTime)){
          return redirect()->back()->withErrors(['end_time'=>"Залата затваря в {$hall->closing_time}"]);
      }
      $existingExams=Exam::where('hall_id',$request->hall_id)
          ->where(function($query) use($startTime,$endTime){
              $query->where('start_time','<',$endTime)
                  ->where('end_time','>',$startTime);
          })->exists();

      if ($existingExams) {
          return back()->withErrors(['hall' => 'Залата е заета през избрания интервал!']);
      }

      // Create the exam with the parsed Carbon dates
      $exam = Exam::create([
         'teacher_id'=>auth()->user()->teacher->id,
          'subject_id' =>$request->subject_id,
          'hall_id' =>$request->hall_id,
          'start_time' =>$startTime,
          'end_time' =>$endTime,
          'max_students'=>$request->max_students,
          'exam_type'=>$request->exam_type,
      ]);

      // Check if the exam was created successfully
      if ($exam) {
          return redirect()->back()->with('success','Изпита е добавен успешно');
      } else {
          return back()->withErrors(['error' => 'Не успяхме да създадем изпита. Моля, опитайте отново.']);
      }

      } catch (\Exception $exception){
          return back()->withErrors(['error' => 'Грешка: ' . $exception->getMessage()]);
      }
  }

    public function create() {
        $subjects = Subject::all();
        $halls = ExamHall::all();
        $bookedSlots = Exam::all()->map(function($exam) {
            return [
                'hall_id' => $exam->hall_id,
                'start' => $exam->start_time->toIso8601String(),
                'end' => $exam->end_time->toIso8601String(),
                'title' => 'Заето'
            ];
        });

        return view('teacher_dashboard', [
            'subjects' => $subjects,
            'halls' => $halls,
            'bookedSlots' => $bookedSlots // Подаване на заетите интервали
        ]);
    }

    /**
     * Fetch all booked slots for a given date and room
     */
    public function getBookedSlots(Request $request) {
        try {
            // Log the incoming request
            \Log::info('Booked slots request received', [
                'date' => $request->date,
                'hall_id' => $request->hall_id,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Validate inputs
            $validated = $request->validate([
                'date' => 'required|date_format:Y-m-d',
                'hall_id' => 'required|integer|exists:exam_halls,id'
            ]);

            try {
                $date = Carbon::parse($request->date);
                $startOfDay = $date->copy()->startOfDay();
                $endOfDay = $date->copy()->endOfDay();

                // Log for debugging
                \Log::info('Fetching booked slots', [
                    'date' => $request->date,
                    'hall_id' => $request->hall_id,
                    'startOfDay' => $startOfDay->toDateTimeString(),
                    'endOfDay' => $endOfDay->toDateTimeString()
                ]);
            } catch (\Exception $e) {
                \Log::error('Error parsing date', [
                    'error' => $e->getMessage(),
                    'date' => $request->date
                ]);
                return response()->json([
                    'error' => 'Invalid date format',
                    'message' => $e->getMessage()
                ], 400);
            }

            // Simplified query to reduce complexity
            $bookedSlots = Exam::where('hall_id', $request->hall_id)
                ->where(function($query) use ($startOfDay, $endOfDay) {
                    // Exams that start during the day
                    $query->whereBetween('start_time', [$startOfDay, $endOfDay])
                        // Or exams that end during the day
                        ->orWhereBetween('end_time', [$startOfDay, $endOfDay])
                        // Or exams that span the entire day
                        ->orWhere(function($q) use ($startOfDay, $endOfDay) {
                            $q->where('start_time', '<=', $startOfDay)
                            ->where('end_time', '>=', $endOfDay);
                        });
                })
                ->get();

            \Log::info('Found booked slots', [
                'count' => $bookedSlots->count()
            ]);

            $formattedSlots = $bookedSlots->map(function($exam) {
                try {
                    return [
                        'id' => $exam->id,
                        'hall_id' => $exam->hall_id,
                        'start' => $exam->start_time->toIso8601String(),
                        'end' => $exam->end_time->toIso8601String()
                    ];
                } catch (\Exception $e) {
                    \Log::error('Error formatting exam', [
                        'exam_id' => $exam->id,
                        'error' => $e->getMessage()
                    ]);
                    return null;
                }
            })->filter(); // Remove any null values

            // Return a well-formed response
            $response = [
                'bookedSlots' => $formattedSlots,
                'date' => $request->date,
                'hall_id' => $request->hall_id,
                'count' => $formattedSlots->count(),
                'timestamp' => now()->toIso8601String()
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            \Log::error('Unhandled exception in getBookedSlots', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
