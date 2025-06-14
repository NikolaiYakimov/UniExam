<?php

namespace App\Http\Controllers;



use App\Http\Requests\GetBookedSlotsRequest;
use App\Http\Requests\StoreExamRequest;
use App\Services\ExamService;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class   ExamController extends Controller
{
//  public function store(StoreExamRequest $request){
//        \Log::info($request->all());
//
//      $request->validated();
//
//      try {
//      $hall = ExamHall::findOrFail($request->hall_id);
//
//      // Parse the date-time strings from the form to Carbon instances
//      $startTime = Carbon::parse($request->start_time);
//      $endTime = Carbon::parse($request->end_time);
//
//      $openingTime=Carbon::parse($hall->opening_time)->setDate($startTime->year,$startTime->month,$startTime->day);
//      $closingTime=Carbon::parse($hall->closing_time)->setDate($startTime->year,$startTime->month,$startTime->day);
//
//      if($startTime->lt($openingTime)){
//          return redirect()->back()->withErrors(['start_time'=>"Залата отваря в {$hall->opening_time}"]);
//      }
//      if($endTime->gt($closingTime)){
//          return redirect()->back()->withErrors(['end_time'=>"Залата затваря в {$hall->closing_time}"]);
//      }
//
//      $existingExams=Exam::where('hall_id',$request->hall_id)
//          ->where(function($query) use($startTime,$endTime){
//              $query->where('start_time','<',$endTime)
//                  ->where('end_time','>',$startTime);
//          })->exists();
//
//          if ($existingExams) {
//          return back()->withErrors(['hall' => 'Залата е заета през избрания интервал!']);
//      }
//
//      // Create the exam with the parsed Carbon dates
//      $exam = Exam::create([
//         'teacher_id'=>auth()->user()->teacher->id,
//          'subject_id' =>$request->subject_id,
//          'hall_id' =>$request->hall_id,
//          'start_time' =>$startTime,
//          'end_time' =>$endTime,
//          'max_students'=>$request->max_students,
//          'exam_type'=>$request->exam_type,
//          'price'=>$request->exam_type==='ликвидация'?$request->price:0,
//      ]);
//
//      // Check if the exam was created successfully
//      if ($exam) {
//          return redirect()->back()->with('success','Изпита е добавен успешно');
//      } else {
//          return back()->withErrors(['error' => 'Не успяхме да създадем изпита. Моля, опитайте отново.']);
//      }
//
//      } catch (\Exception $exception){
//          return back()->withErrors(['error' => 'Грешка: ' . $exception->getMessage()]);
//      }
//  }
//
//
//
//    /**
//     * Fetch all booked slots for a given date and room
//     */
//    public function getBookedSlots(GetBookedSlotsRequest $request) {
//        try {
//            // Validate inputs
//            $validated = $request->validated();
//
//
//                $date = Carbon::parse($request->date);
//                $startOfDay = $date->copy()->startOfDay();
//                $endOfDay = $date->copy()->endOfDay();
//
//
//
//            // Simplified query to reduce complexity
//            $bookedSlots = Exam::where('hall_id', $request->hall_id)
//                ->where(function($query) use ($startOfDay, $endOfDay) {
//                    $query->where('end_time', '>', $startOfDay)
//                        ->where('start_time', '<', $endOfDay);
//                })
//                ->get(['id','hall_id', 'start_time', 'end_time']);
//
//
//
//            $formattedSlots = $bookedSlots->map(function($exam) {
//
//                    return [
//                        'id' => $exam->id,
//                        'hall_id' => $exam->hall_id,
//                        'start' => $exam->start_time->toIso8601String(),
//                        'end' => $exam->end_time->toIso8601String()
//                    ];
//            })->filter(); // Remove any null values
//
//            // Return a well-formed response
//            $response = [
//                'bookedSlots' => $formattedSlots,
//                'date' => $request->date,
//                'hall_id' => $request->hall_id,
//                'count' => $formattedSlots->count(),
//                'timestamp' => now()->toIso8601String()
//            ];
//
//            return response()->json($response);
//        }catch (\Illuminate\Validation\ValidationException $e) {
//            return response()->json([
//                'error' => 'Validation error',
//                'messages' => $e->errors()
//            ], 422);
//        } catch (\Exception $e) {
//            \Log::error('Unhandled exception in getBookedSlots', [
//                'error' => $e->getMessage(),
//                'file' => $e->getFile(),
//                'line' => $e->getLine(),
//                'trace' => $e->getTraceAsString()
//            ]);
//
//            return response()->json([
//                'error' => 'Server error',
//                'message' => $e->getMessage()
//            ], 500);
//        }
//    }

    protected $examService;

    public function __construct(ExamService $examService){
        $this->examService=$examService;

    }
    public function store(StoreExamRequest $request){
        try {
            $request->validated();

            $exam=$this->examService->createExam($request->all());
            return back()->with('success','Изпита е добавен успешно');

        }catch (\Exception $exception){
            return back()->with('error',$exception->getMessage());

        }
    }

    public function getBookedSlots(GetBookedSlotsRequest $request){
        try {
            $slots=$this->examService->getBookedSlots($request->hall_id,$request->date);

            return response()->json([
                'bookedSlots'=>$slots->map(function($exam){
                   return[
                       'id'=>$exam->id,
                       'hall_id'=>$exam->hall_id,
                       'start' => $exam->start_time->toIso8601String(),
                       'end' => $exam->end_time->toIso8601String()
                   ] ;
                })->filter(),
                'date'=>$request->date,
                'hall_id'=>$request->hall_id,
                'count'=>$slots->count(),
                'timestamp'=>now()->toIso8601String()
            ]);
        }catch (\Exception $exception){
            \Log::error('Booked slots error', [
                'method' => __METHOD__,
                'params' => $request->all(),
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);
            return response()->json([
                'error'=>'Грешка при зареждане на запазените часове ',
                'message'=>$exception->getMessage()
            ],500);
        }
    }
}
