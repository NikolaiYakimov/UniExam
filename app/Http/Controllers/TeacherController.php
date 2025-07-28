<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\ExamRegistration;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class TeacherController
{
    public function dashboard():View{
        $teacher = Auth::user()->teacher;
        $exams= Exam::where('teacher_id',$teacher->id)
            ->where('start_time','>',now())
            ->orderBy('start_time', 'desc')
            ->get();
//            ->sortByDesc('start_time')
//            ->values();
        $subjects = Subject::all();
        $halls=ExamHall::all();
        $bookedSlots = Exam::all()->map(function($exam) {
            return [
                'hall_id' => $exam->hall_id,
                'start' => Carbon::parse($exam->start_time)->toIso8601String(),
                'end' => Carbon::parse($exam->end_time) ->toIso8601String(),
                'title' => 'Заето'
            ];
        });

        return view('teacher_dashboard',compact('teacher','exams','subjects','halls','bookedSlots'));
    }

    public function conductedExams():View{
        $teacher=Auth::user()->teacher;
        $exams= Exam::where('teacher_id',$teacher->id)
            ->where('start_time','<',Carbon::now()->toIso8601String())
            ->orderBy('start_time', 'desc')
            ->get();
//        ->sortByDesc('start_time');
        $subjects = Subject::all();
        $halls=ExamHall::all();
        return view('teacher_conducted_exams',compact('teacher','exams','subjects','halls'));
    }
    public function examDetails($examId)
    {
        $exam=Exam::with(['registrations.student.user','subject'])->findOrFail($examId);
        $teacher=Auth::user()->teacher;
        if($exam->teacher_id!==$teacher->id){
            abort(403);
        }

        return view('teacher_exam_details',compact('exam','teacher'));

    }

    public function updateGrades(Request $request,$examId)
    {
        $exam=Exam::findOrFail($examId);
        $teacher=Auth::user()->teacher;

        if($exam->teacher_id!==$teacher->id){
            abort(403);
        }

        $request->validate([
            'grades'=>'required|array',
            'grades.*'=>'nullable|numeric|min:2|max:6'
        ]);

        foreach($request->grades as $registrationId=>$grade){
            $registration=ExamRegistration::find($registrationId);
            if($registration && $registration->exam_id==$examId){
                $registration->grade=$grade?:null;
                $registration->save();
            }
        }

        return back()->with('success', 'Оценките бяха актуализирани успешно!');
    }


}
