<?php

namespace App\Http\Controllers;



use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
  public function store(Request $request){


      $request->validate([
          "subject_id"=>'required|exists:subjects,id',
          'exam_date' =>'required|date',
          'hall_id'=>'required|exists:exam_halls,id',
          'max_students'=>'required|integer|min:1',
          'exam_type'=>'required|in:редовен,поправителен,ликвидация',
      ]);
      ;
      try {

      Exam::create([
         'teacher_id'=>auth()->user()->teacher->id,
          'subject_id' =>$request ->subject_id,
          'hall_id' =>$request->hall_id,
          'start_time' =>$request->start_time,
          'end_time' =>$request->start_time,
          'max_students'=>$request->max_students,
          'exam_type'=>$request->exam_type,
      ]);

      }catch (\Exception $exception){
          dd($exception->getMessage());
      }

      return redirect()->back()->with('success','Изпита е добавен успешно');
  }
}
