<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;

class TeacherController
{
    public function dashboard(){
        $teacher = auth('teacher')->user();
        $exams= Exam::where('teacher_id',$teacher->id)->get();
        $subjects = Subject::all();

        return view('teacher_dashboard',compact('teacher','exams','subjects'));
    }


}
