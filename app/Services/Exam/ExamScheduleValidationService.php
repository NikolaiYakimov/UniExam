<?php

declare(strict_types=1);

namespace App\Services\Exam;

use App\Models\ExamHall;
use Carbon\Carbon;
use Exception;

class ExamScheduleValidationService
{
    /**
     * Валидира, че зала, часови интервал и брой студенти са допустими.
     *
     * @throws Exception
     */
    public function validateExamTime(ExamHall $examHall, Carbon $startTime, Carbon $endTime, int $maxStudents): void
    {
        $hallOpeningTime = Carbon::parse($examHall->opening_time)->setDateFrom($startTime);
        $hallClosingTime = Carbon::parse($examHall->closing_time)->setDateFrom($startTime);

        if ($maxStudents > $examHall->capacity) {
            throw new Exception("Грешка! Максималния брой на студентите не може да надвишава капацитета на залата ({$examHall->capacity})");
        }
        if ($startTime->lt($hallOpeningTime)) {
            throw new Exception("Залата отваря в {$examHall->opening_time}");
        }
        if ($endTime->gt($hallClosingTime)) {
            throw new Exception("Залата затваря в {$examHall->closing_time}");
        }
    }
}
