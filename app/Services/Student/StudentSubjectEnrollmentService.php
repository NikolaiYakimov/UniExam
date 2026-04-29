<?php

declare(strict_types=1);

namespace App\Services\Student;

use App\Models\User;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\Log;

class StudentSubjectEnrollmentService
{
    public function __construct(
        private readonly SubjectRepository $subjectRepository
    ) {}

    /**
     * Записва студент за предметите от дадения семестър и специалност.
     * Извиква се при създаване или обновяване на потребител с роля "student".
     */
    public function enrollStudentInSemesterSubjects(User $user, array $data): void
    {
        if (($data['role'] ?? null) !== 'student' || empty($data['specialty_id']) || empty($data['semester'])) {
            return;
        }

        try {
            $student = $user->student;
            if (!$student) {
                return;
            }

            $newSubjects = $this->subjectRepository->getSubjectsBySemesterAndSpecialty(
                (int) $data['semester'],
                (int) $data['specialty_id']
            );

            if ($newSubjects->count() === 0) {
                return;
            }

            $existingSubjectIds = $this->subjectRepository->getStudentSubjectIdsForSemester(
                $student->id,
                (int) $data['semester']
            );

            $subjectsToAttach = $newSubjects->filter(function ($subject) use ($existingSubjectIds) {
                return !in_array($subject->id, $existingSubjectIds);
            });

            if ($subjectsToAttach->count() > 0) {
                $student->subjects()->attach($subjectsToAttach, ['has_attestation' => true]);
            }
        } catch (\Exception $e) {
            Log::error('Грешка при управление на предмети за студент: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'semester' => $data['semester'],
                'specialty_id' => $data['specialty_id'],
            ]);
        }
    }
}
