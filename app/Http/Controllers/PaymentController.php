<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(private readonly PaymentService $paymentService)
    {}

    //Get the payment of the given student
    public function index(Request $request):JsonResponse
    {
        try {
            $student = $request->user()->student;
            $payments = $this->paymentService->getPaymentRecords($student);

            return response()->json([
                'payments' => $payments,
                'student' => $student
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching payments: ' . $e->getMessage());
            return response()->json([
                'message' => 'error',
                'description' => 'Грешка при зареждане на плащанията']);
        }
    }

    public function handlePayment(Request $request,int $examId)
    {
        try {
            $student = $request->user()->student;
            $result=$this->paymentService->createCheckoutSession($examId, $student);

            return response()->json($result);
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
