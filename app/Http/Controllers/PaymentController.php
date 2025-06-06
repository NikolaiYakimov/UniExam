<?php

namespace App\Http\Controllers;

use App\Models\Exam;
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
                        'unit_amount' => $exam->price*100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', $exam->id),
                'cancel_url' => route('payment.cancel',$exam->id),
                'metadata' => [
                    'stuedent_id'=>auth()->user()->student->id,
                    'exam_id'=>$exam->id,
                ]
            ]);
            return redirect()->away($session->url);
        }catch (\Exception $e){
            return back()->with('error', 'Грешка при плащане: ' . $e->getMessage());
        }

    }

        public function paymentSuccess($examId): void
        {
        $exam=Exam::findOrFail($examId);
        $user=Auth::user();

        $payment=Payment::create([
            'user_id'=>$user->student->id,
            'exam_id'=>$exam->id,
            'amount'=>$exam->price*100,
            'currency'=>'bgn',
            'status'=>'paid',
            'payment_date'=>now(),
        ]);


    }
}
