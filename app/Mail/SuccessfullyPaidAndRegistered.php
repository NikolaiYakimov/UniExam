<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuccessfullyPaidAndRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $exam;
    public $student;
    /**
     * Create a new message instance.
     */
    public function __construct($exam, $student)
    {
        $this->exam = $exam;
        $this->student = $student;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@univesity.com','University Management System'),
            subject: 'Successfully Paid And Registered For The Exam',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.successful-payment-and-registration',
            with: [
                'exam' => $this->exam,
                'student' => $this->student,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
