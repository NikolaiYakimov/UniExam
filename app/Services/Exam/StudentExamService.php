<?php

declare(strict_types=1);

namespace App\Services\Exam;

use App\Models\Exam;
use App\Models\Student;
use App\Repositories\ExamRepositoryInterface;
use Illuminate\Support\Collection;

class StudentExamService
{
    public function __construct(
        private readonly ExamRepositoryInterface $examRepository
    ) {}

    public function getAvailableExams(Student $student): Collection
    {
        $exams = $this->examRepository->getExamsForStudent($student);
        $subjectGrades = $this->getStudentSubjectGrades($student);

        return $exams->filter(function ($exam) use ($subjectGrades, $student) {
            return $this->isExamAvailable($exam, $subjectGrades, $student);
        });
    }

    private function getStudentSubjectGrades(Student $student): Collection
    {
        return $this->examRepository->getStudentSubjectGrades($student);
    }

    private function isExamAvailable(Exam $exam, Collection $subjectGrades, Student $student): bool
    {
        if ($exam->remainingSlots() <= 0) {
            return false;
        }

        $subjectId = $exam->subject_id;
        $isCurrentSemester = $exam->subject->semester == $student->semester;
        $isPastSemester = $exam->subject->semester < $student->semester;

        $grades = $subjectGrades[$subjectId] ?? collect();

        if ($grades->contains('grade', '>=', 3)) {
            return false;
        }

        $hasAttestation = $student->hasAttestationForSubject($subjectId);

        if ($isCurrentSemester) {
            return $this->checkCurrentSemesterExam($exam, $student, $grades, $hasAttestation);
        }

        if ($isPastSemester) {
            return $this->checkPastSemesterExam($exam, $student, $grades, $hasAttestation);
        }

        return false;
    }

    private function checkCurrentSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
    {
        $subjectId = $exam->subject_id;
        $regularGrade = $grades->firstWhere('exam.exam_type', 'редовен')?->grade;
        $correctiveGrade = $grades->firstWhere('exam.exam_type', 'поправителен')?->grade;

        $studentRegularRegistration = $student->registrations()
            ->whereHas('exam', function ($q) use ($subjectId) {
                $q->where('subject_id', $subjectId)->where('exam_type', 'редовен');
            })->exists();

        $studentCorrectiveRegistration = $student->registrations()
            ->whereHas('exam', function ($q) use ($subjectId) {
                $q->where('subject_id', $subjectId)->where('exam_type', 'поправителен');
            })->exists();

        switch ($exam->exam_type) {
            case 'редовен':
                return is_null($regularGrade) && $hasAttestation;
            case 'поправителен':
                return ($regularGrade == 2 || (is_null($regularGrade) && $studentRegularRegistration)) && $hasAttestation;
            case 'ликвидация':
                return ($correctiveGrade == 2 || (is_null($correctiveGrade) && $studentCorrectiveRegistration)) && $hasAttestation;
            default:
                return $hasAttestation;
        }
    }

    private function checkPastSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
    {
        $subjectId = $exam->subject_id;

        if (isset($grades[$subjectId])) {
            $hasPassingGrade = $grades[$subjectId]->contains('grade', '>=', 3);
            if ($hasPassingGrade || !$hasAttestation) {
                return false;
            }
        }

        return in_array($exam->exam_type, ['поправителен', 'ликвидация']);
    }
}
