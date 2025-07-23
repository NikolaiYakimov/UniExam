<?php

namespace App\Services;

use App\Mail\SuccessfullyPaidAndRegistered;
use Exception;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;
use Stripe\Stripe;



class  PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @throws ApiErrorException
     */
    public function  createCheckoutSession(Exam $exam, Student $student )
    {

        $session= Session::create([
            'customer_email'=>Auth::user()->email,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'bgn',
                    'product_data' => [
                        'name' => 'Ликвида  ионен изпит по ' . $exam->subject->subject_name,
                    ],
                    'unit_amount' => $exam->subject->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'ui_mode' => 'embedded',
            'metadata' => [
                'student_id' => $student->id,
                'exam_id' => $exam->id,
            ],
            'return_url' => route('payment.success.embedded').'?session_id={CHECKOUT_SESSION_ID}',
        ]);
        return response()->json(['clientSecret' => $session->client_secret]);
    }

    /**
     * @throws ApiErrorException
     */
    public function handleSuccessfulPayment(string $sessionId): void
    {
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            $this->createRegistrationAndPayment($session);
        }
    }


    public function createRegistrationAndPayment(Session $session):void
    {
        $exam=Exam::findOrFail($session->metadata->exam_id);
        $student=Student::findOrFail($session->metadata->student_id);

        DB::transaction(function () use ($session,$exam) {
//            $exam=Exam::findOrFail($session->metadata->exam_id);
            $student_id=$session->metadata->student_id;
            if($exam->remainingSlots()<=0){
                throw new Exception("Няма свободни места");
            }
            if (Payment::where('stripe_payment_id', $session->payment_intent)->exists()) {
                throw new Exception('Дублиране на плащане');
            }

            $registration=ExamRegistration::create([
                'student_id'=>$student_id,
                'exam_id'=>$exam->id,
            ]);

            Payment::create([
                'student_id'=>$student_id,
                'exam_registration_id'=>$registration->id,
                'stripe_payment_id'=>$session->payment_intent,
                'amount'=>$session->amount_total/100,
                'currency'=>$session->currency,
                'status'=>'paid',
                'payment_date'=>now(),
            ]);
        });
        Mail::to(auth()->user()->email)->queue(new SuccessfullyPaidAndRegistered($exam,$student));
        Log::error("HEyyy");
    }

    public function processRefund(string $paymentIntentId,string $reason='requested_by_customer'): bool
    {
        try{
           $payment=Payment::where('stripe_payment_id', $paymentIntentId)->first();
           Log::debug($payment);
           if(!$payment){
               throw new Exception("Такова плащане не беше намерено");
           }
           if($payment->status!=='paid'){
               throw new Exception("Само изпитите който са платени успешно могат да бъдат върнати");
           }
           Refund::create([
               'payment_intent'=>$paymentIntentId,
               'reason'=>$reason,
           ]);
           $payment->status='refunded';
           $payment->save();
           Log::debug("Payment is successful");
           return true;
        } catch (ApiErrorException $e) {
            Log::error('Refund failed', [
                'payment_intent' => $paymentIntentId,
                'error' => $e->getMessage()
            ]);
            Log::error('------------------------------------------------');
            Log::error('Refund failed: ' . $e->getMessage());
            return false;
        }

    }

}
