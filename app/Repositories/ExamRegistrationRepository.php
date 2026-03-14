<?php

namespace App\Repositories;

use App\Models\ExamRegistration;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Support\Collection;

class ExamRegistrationRepository
{
    public function getActiveStudentRegistrations(Student $student): Collection
    {

        return Exam::whereHas('registrations', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })
            ->with('teacher.user', 'subject', 'hall')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'desc')
            ->get()
            ->map(function ($exam) {
                $exam->remaining_slots = $exam->remainingSlots();
                return $exam;
            });
    }

    public function getPastStudentRegistrations(Student $student): Collection
    {

        return ExamRegistration::query()
            ->with('exam.teacher.user', 'exam.subject', 'exam.hall')
            ->join('exams', 'exam_registrations.exam_id', '=', 'exams.id')
            ->where('exam_registrations.student_id', $student->id)
            ->where('exams.start_time', '<', now())
            ->orderBy('start_time', 'desc')
            ->select('exam_registrations.*')
            ->get();
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

    public function updateExamGrades($examId, $grades)
    {

        foreach ($grades as $registrationId => $grade) {
            ExamRegistration::where('id', $registrationId)
                ->where('exam_id', $examId)
                ->update(['grade' => $grade ?: null]);
        }
    }

}
