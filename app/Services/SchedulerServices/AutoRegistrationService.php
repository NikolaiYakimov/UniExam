<?php

declare(strict_types=1);

namespace App\Services\SchedulerServices;

use App\Repositories\ExamRegistrationRepository;
use App\Repositories\ExamRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AutoRegistrationService
{
    public function __construct(
        private readonly ExamRepository $examRepository,
        private readonly ExamRegistrationRepository $registrationRepository
    ) {}

    public function autoRegistrationForExam(): int
    {
        $today = Carbon::today();

        $exams = $this->examRepository->getTodayExamsWithSpecialties($today);

        $registeredCount = 0;

        foreach ($exams as $exam) {
            if ($exam->end_time < now()) {
                continue;
            }
            if (!$exam->hasAvailableSlots()) {
                Log::info(" No available slots, skipping auto-registration.");
                continue;
            }
            $specialtyIds = $exam->subject->specialties->pluck('id')->toArray();

            $students = $this->examRepository->getEligibleStudentsForAutoRegistration($exam, $specialtyIds);

            foreach ($students as $student) {
                if (!$exam->hasAvailableSlots()) {
                    Log::info("No more available slots for exam {$exam->id}, stopping auto-registration.");
                    break;
                }
                try {
                    $this->registrationRepository->createRegistration([
                        'exam_id' => $exam->id,
                        'student_id' => $student->id,
                        'is_walk_in' => true,
                    ]);
                    $registeredCount++;
                    Log::info("Auto-registered student {$student->id} for exam {$exam->id} as walk-in.");
                    $exam->refresh();
                } catch (\Exception $e) {
                    Log::error("Failed to auto-register student {$student->id} for exam {$exam->id}: " . $e->getMessage());
                }
            }
        }

        return $registeredCount;
    }
}
