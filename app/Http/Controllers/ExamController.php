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
          'exam_hall'=>'required|string',
          'max_students'=>'required|integer|min:1',
          'exam_type'=>'required|in:редовен,поправителен,ликвидация',
      ]);
      ;
      try {

      Exam::create([
         'teacher_id'=>auth('teacher')->id(),
          'subject_id' =>$request ->subject_id,
          'exam_date' =>$request->exam_date,
          'exam_hall' =>$request->exam_hall,
          'max_students'=>$request->max_students,
          'exam_type'=>$request->exam_type,
      ]);

      }catch (\Exception $exception){
          dd($exception->getMessage());
      }

      return redirect()->back()->with('success','Изпита е добавен успешно');
  }
}
