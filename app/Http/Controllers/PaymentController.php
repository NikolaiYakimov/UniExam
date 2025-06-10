<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function handlePayment(Exam $exam){
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
                        'unit_amount' => $exam->subject->price*100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success'). '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'stuedent_id'=>auth()->user()->student->id,
                    'exam-id'=>$exam->id,
                ]
            ]);
            return redirect()->away($session->url);
        }catch (\Exception $e){
            return back()->with('error', 'Грешка при плащане: ' . $e->getMessage());
        }

    }

        public function paymentSuccess(Request $request,$examRegistrationId): \Illuminate\Http\RedirectResponse{

        $examRegistration=ExamRegistration::with('exam.subject')->findOrFail($examRegistrationId);
        $user=Auth::user();
        $sessionId=$request->query('session_id');
        if (!$sessionId) {
            return back()->with('error', 'Невалидна сесия за плащане.');
        }

        $payment=Payment::create([
            'student_id'=>$user->student->id,
            'exam_registration_id'=>$examRegistration->id,
            'amount'=>$examRegistration->exam->subject->price*100,
            'currency'=>'bgn',
            'status'=>'paid',
            'payment_date'=>now(),
        ]);


    }
}
