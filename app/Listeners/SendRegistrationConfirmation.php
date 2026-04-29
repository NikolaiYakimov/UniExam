<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\StudentRegisteredForExam;
use App\Mail\SuccessfullyRegistrated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationConfirmation implements ShouldQueue
{
    public function handle(StudentRegisteredForExam $event): void
    {
        if ($event->student->user?->email) {
            Mail::to($event->student->user->email)
                ->queue(new SuccessfullyRegistrated($event->exam, $event->student));
        }
    }
}
