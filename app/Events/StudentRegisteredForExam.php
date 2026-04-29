<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Exam;
use App\Models\Student;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentRegisteredForExam
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Exam $exam,
        public readonly Student $student
    ) {}
}
