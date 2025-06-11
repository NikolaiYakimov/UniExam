<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Stripe\Refund;
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
                'success_url' => route('payment.success'). '?session_id={CHECKOUT_SESSION_ID}&exam_id='.$exam->id,
                'cancel_url' => route('payment.cancel').'?exam_id='.$exam->id,
                'metadata' => [
                    'stuedent_id'=>auth()->user()->student->id,
                    'exam_id'=>$exam->id,
                ]
            ]);
            return redirect()->away($session->url);
        }catch (\Exception $e){
            Log::error('Payment initiation failed: ' . $e->getMessage());
            return back()->with('error', 'Грешка при плащане: ' . $e->getMessage());
        }

    }

        public function paymentSuccess(Request $request){


        $sessionId=$request->query('session_id');
        $examId=$request->query('exam_id');
        if (!$sessionId) {
            return back()->with('error', 'Невалидна сесия за плащане.');
        }

            try {
                $session=Session::retrieve($sessionId);
                if($session->payment_status==='paid'){
                    $this->createRegistrationAndPayment($session);
                    return redirect()->route('exams')->with('success', 'Успешно плащане и записване за изпит!');
                }
            }catch (\Exception $e){
                Log::error('Payment success handling failed: ' . $e->getMessage());
            }
            return redirect()->route('payment.cancel');

    }
    public function paymentCancel(Request $request){

        return redirect()->route('exams')->with('error',"Плащането беше отменено. Моля, опитайте отново");
    }

    private function createRegistrationAndPayment(Session $session)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $exam = Exam::findOrFail($session->metadata->exam_id);
            $studentId = $session->metadata->student_id;


            if ($exam->remainingSlots() <= 0) {
               throw new \Exception("Няма свободни места");
            }

            if(Payment::where('stripe_payment_id',$session->payment_intent)->exists()){
                throw new \Exception("Дублирано плащане");
            }
            //Use DB::transaction to be sure if one of the creating action failed , all the changes to be rollback
            DB::transaction(function() use ($session,$exam,$studentId){
                $registration = ExamRegistration::create([
                    'student_id' => $session->metadata->student_id,
                    'exam_id' => $session->metadata->exam_id,
                ]);

                Payment::create([
                    'student_id' => $session->metadata->student_id,
                    'exam_registration_id' => $registration->id,
                    'stripe_payment_id' => $session->payment_intent,
                    'amount' => $session->amount_total / 100,
                    'currency' => $session->currency,
                    'status' => 'paid',
                    'payment_date' => now(),
                ]);
            });
        }catch (\Exception $e){
            $this->processRefund($session->payment_intent,$e->getMessage());
            return redirect()->route('exams')->with('error', "Грешка: {$e->getMessage()}. Парите ще бъдат върнати.");
        }
    }

    private function processRefund($paymentIntentId,$reason)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            $refund = Refund::create([
                'payment_intent' => $paymentIntentId,
                'reason' => 'requested_by_customer'
            ]);
        }catch (\Exception $e){
            Log::error('Refund failed', [
                'payment_intent' => $paymentIntentId,
                'error' => $e->getMessage()
            ]);
        }
    }
}
