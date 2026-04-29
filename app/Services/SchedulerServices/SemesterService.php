<?php

declare(strict_types=1);

namespace App\Services\SchedulerServices;

use App\Repositories\AcademicSemesterRepository;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SemesterService
{
    public function __construct(
        private readonly AcademicSemesterRepository $semesterRepository,
        private readonly StudentRepository $studentRepository
    ) {}

    public function updateCurrentSemester(): bool
    {
        $today = Carbon::today();

        $currentSemester = $this->semesterRepository->getCurrentSemester();
        $nextSemester = $this->semesterRepository->getNextSemester($today);

        Log::info('В сървиза съм');

        if ($nextSemester && !$nextSemester->is_current && $today->greaterThanOrEqualTo(Carbon::parse($nextSemester->start_date))) {
            if ($currentSemester) {
                $this->semesterRepository->updateSemester($currentSemester, [
                    'is_current' => false,
                    'start_date' => Carbon::parse($currentSemester->start_date)->addYears(),
                    'end_date' => Carbon::parse($currentSemester->end_date)->addYear(),
                ]);
            }

            $this->semesterRepository->updateSemester($nextSemester, [
                'is_current' => true
            ]);

            $this->studentRepository->incrementSemesterForAllEligible(8);

            return true;
        }

        return false;
    }
}
