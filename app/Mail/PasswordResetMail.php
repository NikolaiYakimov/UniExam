<?php

namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\Factory as Queue;

class PasswordResetMail extends Mailable
{

    use Queueable, SerializesModels;

    public $token;
    public $user;

    public function __construct($token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Заявка за възстановяване на парола')
            ->view('emails.password-reset')
            ->with([
                'token' => $this->token,
                'user' => $this->user,
            ]);
    }
}
