<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\ExamUpdated;
use App\Mail\ExamUpdatedMail;
use App\Repositories\ExamRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendExamUpdatedNotification implements ShouldQueue
{
    public function __construct(
        private readonly ExamRepository $examRepository
    ) {}

    public function handle(ExamUpdated $event): void
    {
        $registeredStudents = $this->examRepository->getRegisteredStudentsForExam($event->exam)
            ->pluck('student.user')
            ->filter();

        foreach ($registeredStudents as $user) {
            if ($user->email) {
                Mail::to($user->email)->queue(new ExamUpdatedMail($event->exam));
            }
        }
    }
}
