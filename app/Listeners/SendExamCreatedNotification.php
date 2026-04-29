<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ExamCreated;
use App\Mail\ExamCreatedMail;
use App\Repositories\StudentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendExamCreatedNotification implements ShouldQueue
{
    public function __construct(
        private readonly StudentRepository $studentRepository
    ) {}

    public function handle(ExamCreated $event): void
    {
        $students = $this->studentRepository->getAllStudentsWithEmail();

        foreach ($students as $student) {
            Mail::to($student->user->email)->queue(new ExamCreatedMail($event->exam));
        }
    }
}
