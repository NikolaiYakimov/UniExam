<?php

namespace App\Repositories;

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
}
