<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamRegistration;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function exams(): \Illuminate\Contracts\View\View
    {
        $exams = Exam::with(['teacher', 'subject'])->
        where('exam_date', '>', now())->
        get()->
        filter(fn($exam) => $exam->remainingSlots() > 0);

        return view('exams', compact('exams'));
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
