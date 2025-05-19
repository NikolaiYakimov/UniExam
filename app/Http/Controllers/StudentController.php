<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //Get the exams which the student didn't registe
    public function exams(): \Illuminate\Contracts\View\View
    {
        //Get the exams which the student didn't register
        /** @var \App\Models\Student $student */
        $student = Auth::user()->student;
        $registeredExamIds = $student->registrations()->pluck('exam_id');

        $exams=Exam::with(['teacher', 'subject'])
            ->where('start_time', '>', now())
            ->whereNotIn('id', $registeredExamIds)
            ->get()
            ->filter(fn($exam) => $exam->remainingSlots() > 0);

        return view('exams', compact('exams'));
    }
        public function myExams(){
        /** @var \App\Models\Student $student */
        $student = auth('student')->user();
        $registrations=$student->registrations()
            ->with('exam.teacher', 'exam.subject')
            ->get()
            ->pluck('exam');

        return view('my_exams',[
            'exams' => $registrations,
            'student' => $student
]);
        }
    public function register(Request $request, Exam $exam)
    {
        if ($exam->remainingSlots() <= 0) {
            return back()->with('error', 'Няма свободни места!');
        }
        if ($exam->registrations()->where('student_id', auth('student')->id())->exists()) {
            return back()->with('error', 'Вече сте записани за този изпит!');
        }

        ExamRegistration::create([
            'student_id' => auth('student')->id(),
            'exam_id' => $exam->id,
        ]);

        return  redirect()->route('exams')->with('success', 'Успешно се записахте за изпит!');

    }
}
