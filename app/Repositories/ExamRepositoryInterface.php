<?php

namespace App\Repositories;

use App\Models\Exam;

use App\Models\Student;
use Illuminate\Support\Collection;

interface ExamRepositoryInterface
{
    public function hasOverlap( $hallId,  $startTime,  $endTime);
    public function store($data):Exam;
    public function getBookedSlots($hallId, $startTime, $endTime,int $excludeExamId);
    public function getExamsForStudent(Student $student): Collection;

    public function getRegisteredExams(Student $student): Collection;

    public function getExamById(int $id): ?Exam;

    public function getExamsBySubjectAndType(int $subjectId, string $examType): Collection;

    public function getUpcomingExams(): Collection;

    public function getPastExams(): Collection;

    public function getExamsWithAvailableSlots(): Collection;

//    public function createExamRegistration(Student $student, Exam $exam): bool;
//
//    public function deleteExamRegistration(Student $student, Exam $exam): bool;
//
//    public function getExamRegistrations(Student $student): Collection;
//    public function getTeacherUpcomingExams($teacherId);
//    public function getConductedExams($teacherId);
//    public function getExamDetails($examId);
//    public function updateExamGrades($examId, $grades);
//    public function getBookedTimeSlots();
}
