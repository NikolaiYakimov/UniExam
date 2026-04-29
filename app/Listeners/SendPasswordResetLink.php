<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use App\Mail\PasswordResetMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetLink implements ShouldQueue
{
    public function handle(PasswordResetRequested $event): void
    {
        try {
            Mail::to($event->user->email)
                ->queue(new PasswordResetMail($event->token, $event->user));
        } catch (\Throwable $e) {
            Log::error('Failed to send password reset email: ' . $e->getMessage());
        }
    }
}
