<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Stripe\Refund;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function handlePayment(Exam $exam){

        try{
            return $this->paymentService->createCheckoutSession($exam, auth()->user()->student);

//            return redirect()->away($session->url,303);
        }catch (\Exception $e){
//            Log::error('Payment initiation failed: ' . $e->getMessage());
////            return back()->with('error', 'Грешка при плащане: ' . $e->getMessage());
//            return response()->json([
//                'error' => 'Грешка при плащане: ' . $e->getMessage()
//            ], 500);
            Log::error('Payment initiation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Грешка при плащане: ' . $e->getMessage()], 500);
        }

    }

        public function paymentSuccess(Request $request){
            try {
                     $sessionId=$request->query('session_id');

                     if (!$sessionId) {
                        return back()->with('error', 'Невалидна сесия за плащане.');
                     }

                     $this->paymentService->handleSuccessfulPayment($sessionId);
                     return redirect()->route('exams')->with('success', 'Успешно плащане и записване за изпит!');
            }catch (\Exception $e){
                Log::error('Payment success handling failed: ' . $e->getMessage());
                return redirect()->route('payment.cancel')->with('error', $e->getMessage());
            }


    }
    public function paymentCancel(Request $request){

        return redirect()->route('exams')->with('error',"Плащането беше отменено. Моля, опитайте отново");
    }

    private function createRegistrationAndPayment(Session $session)
    {
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
