<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;

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
            ->where('start_time ', '>', now())
            ->whereNotIn('id', $registeredExamIds)
            ->get()
            ->filter(fn($exam) => $exam->remainingSlots() > 0);

        return view('exams', compact('exams'));
    }
        public function myExams(){
        /** @var \App\Models\Student $student */
        $student = auth()->user()->student;
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
        if ($exam->registrations()->where('student_id', auth()->user()->student->id)->exists()) {
            return back()->with('error', 'Вече сте записани за този изпит!');
        }
        if($exam->exam_type==='ликвидация'){
            return $this->handlePayment($exam);
        }
        ExamRegistration::create([
            'student_id' => auth()->user()->student->id,
            'exam_id' => $exam->id,
        ]);

        return  redirect()->route('exams')->with('success', 'Успешно се записахте за изпит!');

    }

    private function handlePayment(Exam $exam)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try{
            $session=Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'bgn',
                        'product_data' => [
                            'name'=>'Ликвидационен изпит по'.$exam->subject->subject_name,
                        ],
                        'unit_amount' => $exam->price*100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', $exam->id),
                'cancel_url' => route('payment.cancel',$exam->id),
                'metadata' => [
                   'user_id'=>auth()->user()->id,
                    'exam_id'=>$exam->id,
                ]
            ]);
            return redirect()->away($session->url);

        }catch (\Exception $exception){
            return back()->with('error','Грешка при плащане: '.$exception->getMessage());
        }
    }

    public function paymentSuccess($examId){
        $exam=Exam::findOrFail($examId);
        $user=auth()->user;

        $payment=Payment::create([
            'user_id'=>$user->id,
            'exam_id'=>$exam->id,
            'amount'=>$exam->price*100,
            'currency'=>'bgn',
            'status'=>'paid',
            'payment_date'=>now(),
        ]);



    }

}


