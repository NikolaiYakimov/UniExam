<?php

namespace App\Repositories;

use App\Models\ExamRegistration;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Support\Collection;

class ExamRegistrationRepository
{
    public function getStudentRegistrations(Student $student): Collection
    {
        return $student->registrations()
            ->with(['exam.teacher', 'exam.subject', 'exam.hall'])
            ->get()
            ->pluck('exam')
            ->where('start_time', '>=', now())
            ->sortByDesc('start_time')
            ->values();
    }

    public function getPastStudentRegistrations(Student $student): Collection
    {
        return $student->registrations()
            ->with(['exam.teacher', 'exam.subject', 'exam.hall'])
            ->get()
            ->pluck('exam')
            ->where('start_time', '<=', now())
            ->sortByDesc('start_time')
            ->values();
    }


    public function createRegistration(array $data): ExamRegistration
    {
        return ExamRegistration::create($data);
    }

    public function findRegistration(int $studentId, int $examId): ?ExamRegistration
    {
        return ExamRegistration::where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->first();
    }

    public function deleteRegistration(ExamRegistration $registration): bool
    {
        return $registration->delete();
    }

    public function checkExistingRegistration(int $studentId, int $examId): bool
    {
        return ExamRegistration::where('student_id', $studentId)
            ->where('exam_id', $examId)
            ->exists();
    }
}
