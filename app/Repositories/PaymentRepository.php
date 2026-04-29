<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Collection;


class PaymentRepository
{
    public function getPaymentRecords(Student $student): Collection
    {
        return  $student->payments()
            ->with('registration.exam.subject')
            ->orderBy('payment_date', 'desc')
            ->get();
    }

    public function paymentExistsWithIntent(string $paymentIntentId): bool
    {
        return Payment::where('stripe_payment_id', $paymentIntentId)->exists();
    }

    public function createPayment(array $data): Payment
    {
        return Payment::create($data);
    }

    public function findPaymentByIntent(string $paymentIntentId): ?Payment
    {
        return Payment::where('stripe_payment_id', $paymentIntentId)->first();
    }

    public function updatePaymentStatus(Payment $payment, string $status): bool
    {
        return $payment->update(['status' => $status]);
    }
}
