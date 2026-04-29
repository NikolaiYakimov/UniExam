<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PaymentCompleted;
use App\Mail\SuccessfullyPaidAndRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentConfirmation implements ShouldQueue
{
    public function handle(PaymentCompleted $event): void
    {
        if ($event->student->user?->email) {
            Mail::to($event->student->user->email)
                ->queue(new SuccessfullyPaidAndRegistered($event->exam, $event->student));
        }
    }
}
