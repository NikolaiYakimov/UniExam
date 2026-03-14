<?php

namespace App\Services;

use App\Mail\ExamCreatedMail;
use App\Mail\ExamUpdatedMail;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Repositories\ExamHallRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Exception;

class ExamService
{
    public function __construct(
        private readonly ExamRepositoryInterface $examRepository,
        private readonly ExamHallRepository $examHallRepository
    ) {
    }


    // Teacher Methods

    public function getTeacherDashboardData(Teacher $teacher): array
    {
        $exams = $this->examRepository->getTeacherUpcomingExams($teacher->id);

        return [
            "exams" => $exams,
            "teacher" => $teacher,
            "subjects" => $teacher->subjects,
            "halls" => ExamHall::all(),
        ];
    }

    public function createExam(array $data, Teacher $teacher): Exam
    {
        $hall = $this->examHallRepository->getExamHallById($data['hall_id']);
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        $this->validateExamTime($hall, $startTime, $endTime, $data['max_students']);

        if ($this->examRepository->hasOverlap($hall->id, $startTime, $endTime)) {
            throw new Exception("Залата е заета през избрания интервал");
        }

        $exam = $this->examRepository->store([
            'teacher_id' => $teacher->id,
            'subject_id' => $data['subject_id'],
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
            'exam_type' => $data['exam_type'],
        ]);

        $this->notifyAllStudentsForNewExam($exam);

        return $exam;
    }

    public function getExamDetailsForTeacher(int $examId, Teacher $teacher): Exam
    {
        $exam = $this->examRepository->getExamDetails($examId);
        if ($exam->teacher_id !== $teacher->id) {
            throw new Exception('Нямате права над този изпит!');
        }

        return $exam;
    }

    /**
     * @throws AuthorizationException
     */
    public function getExamForEdit(int $examId, int $teacherId): Exam
    {
        $exam = $this->examRepository->getExamByIdForEdit($examId);

        if ($exam->teacher_id !== $teacherId) {
            throw new AuthorizationException("Нямате право да редактирате този изпит");
        }

        return $exam;
    }

    /**
     * @throws Exception
     */
    public function updateExam(int $examId, array $data): Exam
    {
        $exam = $this->examRepository->getExamById($examId);

        if ($exam->subject_id != $data['subject_id']) {
            throw new Exception("Предмета не може да бъде променян");
        }
        if ($exam->exam_type != $data['exam_type']) {
            throw new Exception('Типът на изпита не може да бъде променян');
        }

        $hall = $this->examHallRepository->getExamHallById($data['hall_id']);
        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);
        $now = Carbon::now();

        $oldExamStart = Carbon::parse($exam->start_time);

        if ($oldExamStart->isPast()) {
            throw new Exception("Датата на изпита е вече минала и не може да се редактира.");
        }
        if ($now->diffInHours($oldExamStart, false) <= 48) {
            throw new Exception("Изпита не може да бъде редактиран, тъй като започва след по-малко от 48 часа.");
        }

        $this->validateExamTime($hall, $startTime, $endTime, $data['max_students']);

        if ($startTime->isPast() || $now->diffInHours($startTime, false) <= 48) {
            throw new Exception('Новият час не може да бъде насрочен в миналото или по-рано от 48 часа от текущия момент. Моля, изберете валидни дата и час.');
        }

        if ($this->examRepository->hasOverlap($hall->id, $startTime, $endTime, $exam->id)) {
            throw new Exception("Залата е заета за избрания от вас интервал от време.");
        }

        $updateData = [
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
        ];

        $newExam = $this->examRepository->update($exam, $updateData);
        $this->notifyRegisteredStudentsForExamUpdate($exam);

        return $newExam;
    }

    public function getConductedExams(Teacher $teacher): array
    {
        $exams = $this->examRepository->getConductedExams($teacher->id);

        return [
            'teacher' => $teacher,
            'exams' => $exams,
            'subjects' => Subject::all(),
            'halls' => ExamHall::all(),
        ];
    }

    public function getExamWithRegisteredStudents(int $examId): array
    {
        $exam = $this->examRepository->getExamDetails($examId);

        $students = $exam->registrations->map(function ($registration) {
            if ($registration->student) {
                return [
                    'id' => $registration->student->id,
                    'first_name' => $registration->student->user->first_name,
                    'second_name' => $registration->student->user->second_name,
                    'last_name' => $registration->student->user->last_name,
                    'faculty_number' => $registration->student->faculty_number,
                    'email' => $registration->student->user->email,
                ];
            }
            return null;
        })->filter()->values();

        return [
            'exam' => [
                'id' => $exam->id,
                'subject_name' => $exam->subject->subject_name,
                'exam_type' => $exam->exam_type,
                'start_time' => $exam->start_time->toIso8601String(),
            ],
            'students' => $students,
        ];
    }

    //Student Methods

    public function getAvailableExams(Student $student): Collection
    {
        $exams = $this->examRepository->getExamsForStudent($student);
        $subjectGrades = $this->getStudentSubjectGrades($student);

        return $exams->filter(function ($exam) use ($subjectGrades, $student) {
            return $this->isExamAvailable($exam, $subjectGrades, $student);
        });
    }


    // Shared Methods


    public function getBookedSlots(int $hallId, string $date, int $excludeExamId = null): Collection
    {
        $dateObj = Carbon::parse($date);
        $start = $dateObj->copy()->startOfDay();
        $end = $dateObj->copy()->endOfDay();

        return $this->examRepository->getBookedSlots($hallId, $start, $end, $excludeExamId);
    }

    //Helper Methods
    private function validateExamTime(ExamHall $examHall, Carbon $startTime, Carbon $endTime, int $maxStudents): void
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

    protected function notifyAllStudentsForNewExam(Exam $exam): void
    {
        $students = Student::with('user')->whereHas('user', function ($q) {
            $q->whereNotNull('email');
        })->get();

        foreach ($students as $student) {
            Mail::to($student->user->email)->queue(new ExamCreatedMail($exam));
        }
    }

    protected function notifyRegisteredStudentsForExamUpdate(Exam $exam): void
    {
        $registeredStudents = $this->examRepository->getRegisteredStudentsForExam($exam)
            ->pluck('student.user')
            ->filter();

        foreach ($registeredStudents as $student) {
            if ($student->email) {
                Mail::to($student->email)->queue(new ExamUpdatedMail($exam));
            }
        }
    }

    protected function getStudentSubjectGrades(Student $student): Collection
    {
        return $this->examRepository->getStudentSubjectGrades($student);
    }

    protected function isExamAvailable(Exam $exam, Collection $subjectGrades, Student $student): bool
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

    protected function checkCurrentSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
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

    protected function checkPastSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
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
