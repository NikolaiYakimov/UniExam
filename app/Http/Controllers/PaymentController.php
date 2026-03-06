<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
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
    protected $paymentRepository;

    public function __construct(PaymentService $paymentService, PaymentRepository $paymentRepository)
    {
        $this->paymentService = $paymentService;
        $this->paymentRepository = $paymentRepository;
    }

    public function student_payments()
    {
        try {
            $student = auth()->user()->student;
            $payments = $this->paymentRepository->getPaymentRecords($student);

            return response()->json([
                'payments' => $payments,
                'student' => $student]);

        } catch (\Exception $e) {
            Log::error('Error fetching payments: ' . $e->getMessage());
            response()->json([
                'message' => 'error',
                'description' => 'Грешка при зареждане на плащанията']);
        }
    }

    public function handlePayment(Request $request,int $examId)
    {

        try {
            Log::debug("Тук съм да плащам");
            $student = $request->user()->student;
            return $this->paymentService->createCheckoutSession($examId, $student);
        } catch (\Exception $e) {
            Log::error('Payment initiation failed: ' . $e->getMessage());
            return response()->json(['error' => 'Грешка при плащане: ' . $e->getMessage()], 500);
        }

    }

    public function paymentSuccess(Request $request)
    {
        try {
            $sessionId = $request->query('session_id');

            if (!$sessionId) {
                return response()->json(['error' => 'Невалидна сесия за плащане.'], 422);
            }
            $this->paymentService->handleSuccessfulPayment($sessionId);

            $frontendUrl = config('app.frontend_url') . '/exams?payment=success';
            return redirect($frontendUrl);
        } catch (\Exception $e) {

            \Log::error('Payment success handling failed: ' . $e->getMessage());
            $frontendUrl = config('app.frontend_url') . '/exams?payment=error&message=' . urlencode($e->getMessage());
            return redirect($frontendUrl);
        }


    }

    public function paymentCancel(Request $request)
    {

        return redirect()->route('exams')->with('error', "Плащането беше отменено. Моля, опитайте отново");
    }


    public function processRefund(Request $request): \Illuminate\Http\JsonResponse
    {
        $paymentIntent = $request->input('paymentIntent');
        $reason = $request->input('reason', 'Refund request');

        $success = $this->paymentService->processRefund($paymentIntent, $reason);

        return $success
            ? response()->json(['message' => 'Refund successful'])
            : response()->json(['error' => 'Refund failed'], 500);
    }
}
