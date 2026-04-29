<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Exam;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExamCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Exam $exam
    ) {}
}
