<?php

declare(strict_types=1);

namespace App\Services\Exam;

use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ExamScheduleService
{
    public function __construct(
        private readonly ExamRepositoryInterface $examRepository
    ) {}

    public function getBookedSlots(int $hallId, string $date, ?int $excludeExamId = null): Collection
    {
        $dateObj = Carbon::parse($date);
        $start = $dateObj->copy()->startOfDay();
        $end = $dateObj->copy()->endOfDay();

        return $this->examRepository->getBookedSlots($hallId, $start, $end, $excludeExamId);
    }
}
