<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\PaymentCompleted;
use App\Models\Student;
use App\Repositories\ExamRegistrationRepository;
use App\Repositories\ExamRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\StudentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Refund;
use Stripe\Stripe;

class PaymentService
{
    public function __construct(
        private readonly ExamRepository $examRepository,
        private readonly PaymentRepository $paymentRepository,
        private readonly ExamRegistrationRepository $registrationRepository,
        private readonly StudentRepository $studentRepository
    ) {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * @throws ApiErrorException
     */
    public function createCheckoutSession(int $examId, Student $student): \Illuminate\Http\JsonResponse
    {
        $exam = $this->examRepository->getExamById($examId);
        $session = Session::create([
            'customer_email' => $student->user->email,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Ликвидационен изпит по ' . $exam->subject->subject_name,
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
            'return_url' => route('payment.success.embedded') . '?session_id={CHECKOUT_SESSION_ID}',
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

    /**
     * @throws Exception
     */
    public function createRegistrationAndPayment(Session $session): void
    {
        $exam = $this->examRepository->getExamById((int) $session->metadata->exam_id);
        $student = $this->studentRepository->getStudentById((int) $session->metadata->student_id);

        DB::transaction(function () use ($session, $exam) {
            $student_id = (int) $session->metadata->student_id;
            if ($exam->remainingSlots() <= 0) {
                throw new Exception("Няма свободни места");
            }
            if ($this->paymentRepository->paymentExistsWithIntent($session->payment_intent)) {
                throw new Exception('Дублиране на плащане');
            }

            $registration = $this->registrationRepository->createRegistration([
                'student_id' => $student_id,
                'exam_id' => $exam->id,
            ]);

            $this->paymentRepository->createPayment([
                'student_id' => $student_id,
                'exam_registration_id' => $registration->id,
                'stripe_payment_id' => $session->payment_intent,
                'amount' => $session->amount_total / 100,
                'currency' => $session->currency,
                'status' => 'paid',
                'payment_date' => now(),
            ]);
        });

        event(new PaymentCompleted($exam, $student));
    }

    public function processRefund(string $paymentIntentId, string $reason = 'requested_by_customer'): bool
    {
        try {
            $payment = $this->paymentRepository->findPaymentByIntent($paymentIntentId);
            if (!$payment) {
                throw new Exception("Такова плащане не беше намерено");
            }
            if ($payment->status !== 'paid') {
                throw new Exception("Само изпитите който са платени успешно могат да бъдат върнати");
            }
            Refund::create([
                'payment_intent' => $paymentIntentId,
                'reason' => $reason,
            ]);
            $this->paymentRepository->updatePaymentStatus($payment, 'refunded');

            return true;
        } catch (ApiErrorException $e) {
            Log::error('Refund failed', [
                'payment_intent' => $paymentIntentId,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function getPaymentRecords(Student $student): mixed
    {
        $records = $this->paymentRepository->getPaymentRecords($student);
        if ($records->isEmpty()) {
            throw new Exception("Няма налични плащания");
        }

        return $records;
    }
}
