<?php

namespace App\Http\Controllers;



use App\Models\Exam;
use App\Models\ExamHall;
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
          'start_time'=>'required|date',
          'end_time'=>'required|date ',

      ]);
      try {
      $hall = ExamHall::findOrFail($request->hall_id);

      $startTime=Carbon::parse($request->start_time);
      $endTime=Carbon::parse($request->end_time);
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


      Exam::create([
         'teacher_id'=>auth()->user()->teacher->id,
          'subject_id' =>$request ->subject_id,
          'hall_id' =>$request->hall_id,
          'start_time' =>$startTime,
          'end_time' =>$endTime,
          'max_students'=>$request->max_students,
          'exam_type'=>$request->exam_type,
      ]);
          return redirect()->back()->with('success','Изпита е добавен успешно');
      }catch (\Exception $exception){
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
}
