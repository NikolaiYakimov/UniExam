<?php

namespace App\Services;

use Exception;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;
use Stripe\Stripe;



class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @throws ApiErrorException
     */
    public function createCheckoutSession(Exam $exam, Student $student )
    {

        $session= Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'bgn',
                    'product_data' => [
                        'name' => 'Ликвидационен изпит по ' . $exam->subject->subject_name,
                    ],
                    'unit_amount' => $exam->subject->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'student_id' => $student->id,
                'exam_id' => $exam->id,
            ],
            'return_url' => route('payment.success.embedded'),
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
        DB::transaction(function () use ($session) {
            $exam=Exam::findOrFail($session->metadata->exam_id);
            $student_id=$session->metadata->student_id;
            if($exam->remainingSlots()<=0){
                throw new Exception("Няма свободни места");
            }
            if(Payment::where('stripe_payment_id',$session->payment_intent)->exist()){
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
    }

    public function processRefund(string $paymentIntentId,string $reason='Няма наличие на места'):void
    {
        try{
            Refund::create([
                'payment_intent'=>$paymentIntentId,
                'reason'=>$reason,
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Refund failed', [
                'payment_intent' => $paymentIntentId,
                'error' => $e->getMessage()
            ]);
        }

    }

}
