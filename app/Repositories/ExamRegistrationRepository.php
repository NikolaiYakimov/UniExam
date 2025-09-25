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
            ->with(['exam.teacher.user', 'exam.subject', 'exam.hall'])
            ->get()
            ->pluck('exam')
            ->where('start_time', '>=', now())
            ->sortByDesc('start_time')
            ->values()
            ->map(function ($exam) {
                $exam->remaining_slots=$exam->remainingSlots();
                return $exam;
            });
    }

    public function getPastStudentRegistrations(Student $student): Collection
    {
//        return $student->registrations()
//            ->with(['exam.teacher.user', 'exam.subject', 'exam.hall','exam'])
//            ->get()
//            ->pluck('exam')
//            ->where('start_time', '<=', now())
//            ->sortByDesc('start_time')
//            ->values();
//        return $student->registrations()
//            ->with(['exam.teacher.user', 'exam.subject', 'exam.hall'])
//            ->get()
//            ->filter(function ($registration) {
//                return $registration->exam && $registration->exam->start_time <= now();
//            })
//            ->sortByDesc('exam.start_time')
//            ->values();
        return $student->registrations()
            ->with(['exam.teacher.user', 'exam.subject', 'exam.hall'])
            ->whereHas('exam', function($query) {
                $query->where('start_time', '<=', now());
            })
            ->get()
            ->sortByDesc('exam.start_time')
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

    public function getExamDetails($examId)
    {
        return Exam::with(['registrations.student.user', 'subject','hall'])->findOrFail($examId);
    }

    public function updateExamGrades($examId, $grades)
    {
        foreach ($grades as $registrationId => $grade) {
            $registration = ExamRegistration::find($registrationId);
            if ($registration && $registration->exam_id == $examId) {
                $registration->grade = $grade ?: null;
                $registration->save();
            }
        }
    }


}
