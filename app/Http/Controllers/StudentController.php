<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;

class StudentController extends Controller
{
//    public function showPaymentForm(Exam $exam)
//    {
//        return view('payment_form',compact('exam'));
//    }
    //Get the exams which the student didn't register
    public function exams(): \Illuminate\Contracts\View\View
    {
        //Get the exams which the student didn't register
        /** @var \App\Models\Student $student */
        $student = Auth::user()->student;
        $registeredExamIds = $student->registrations()->pluck('exam_id');

        $exams=Exam::with(['teacher', 'subject'])
            ->whereHas('subject',function ($q) use ($student){
                $q->where('semester',$student->semester);
            } )
            ->where('start_time', '>', now())
            ->whereNotIn('id', $registeredExamIds)
            ->get()
            ->filter(fn($exam) => $exam->remainingSlots() > 0);

        return view('exams', compact('exams'));
    }
        public function myExams(){
        /** @var \App\Models\Student $student */
        $student = auth()->user()->student;
        $registrations=$student->registrations()
            ->with(['exam.teacher', 'exam.subject'])
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
        if ($exam->registrations()->where('student_id', auth()->user()->student->id)->exists()) {
            return back()->with('error', 'Вече сте записани за този изпит!');
        }
        if($exam->exam_type==='ликвидация'){
            return redirect()->route('payment.handle',['exam'=>$exam]);
        }
        ExamRegistration::create([
            'student_id' => auth()->user()->student->id,
            'exam_id' => $exam->id,
        ]);
        Mail::to( auth()->user()->email)->queue(new SuccessfullyRegistrated($exam, auth()->user()->student));

        return  redirect()->route('exams')->with('success', 'Успешно се записахте за изпит!');

    }

}


