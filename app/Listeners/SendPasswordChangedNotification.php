<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PasswordChanged;
use App\Mail\PasswordChangedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPasswordChangedNotification implements ShouldQueue
{
    public function handle(PasswordChanged $event): void
    {
        try {
            if (!empty($event->user->email)) {
                Mail::to($event->user->email)
                    ->queue(new PasswordChangedMail($event->user, now()));
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send PasswordChangedMail', [
                'user_id' => $event->user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
