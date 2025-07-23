<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Services\PaymentService;
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
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
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
            ->orderBy('start_time','desc')
            ->get()
            ->filter(fn($exam) => $exam->remainingSlots() > 0);

        //Sort the exams by date
//        $sortedExams=$exams->sortBy()

        return view('exams', compact('exams'));
    }
        public function myExams(){
        /** @var \App\Models\Student $student */
        $student = auth()->user()->student;
        $registeredExams=$student->registrations()
            ->with(['exam.teacher', 'exam.subject'])
            ->get()
            ->pluck('exam')
            ->sortByDesc('start_time')
            ->values();


        return view('my_exams',[
            'exams' => $registeredExams,
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
    public function unregisterExam(Exam $exam,PaymentController $paymentController): \Illuminate\Http\RedirectResponse
    {
        $studentId=auth()->user()->student->id;
        $registration=ExamRegistration::where('student_id',$studentId)
            ->where('exam_id',$exam->id)->first();

        if(!$registration){
            return back()->with("error","Не може да се опишете, защото не сте записани за този изпит!");
        }
        if($exam->start_time->isPast()){
            return back()->with("error","Отписването е невъзможно, тъй като изпита вече е минал");
        }

        if($exam->start_time->diffInHours(now(),true)<48){
            return back()->with("error","Отисването от дадения изпит е невъзможно по-малко от 48 часа преди изпита");
        }

        if($exam->exam_type==="ликвидация"&&$registration->payment){
//            $payment=Payment::where('exam_registration_id',$registration->id)
//            ->where('student_id',\auth()->user()->student->id)->first();
//            if($payment && $payment->status === "paid"){
                $refundSuccess=$this->paymentService->processRefund($registration->payment->stripe_payment_id,"requested_by_customer");
                if(!$refundSuccess){
                    return back()->with('error',"Грешка при връщането на парите");
                }

            }
        $registration->delete();
        return back()->with("success","Успешно се отписахте от изпита");
    }

}


