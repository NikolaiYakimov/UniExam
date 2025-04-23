<?php

namespace App\Http\Controllers;

use App\Models\Exam;

class TeacherController
{
    public function dashboard(){
        $teacher = auth('teacher')->user();
        $exams= Exam::where('teacher_id',$teacher->id)->get();

        return view('teacher_dashboard',compact('teacher','exams'));
    }


}
