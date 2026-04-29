<?php

declare(strict_types=1);

namespace App\Services\Exam;

use App\DTOs\CreateExamDto;
use App\DTOs\UpdateExamDto;
use App\DTOs\UpdateGradeDto;
use App\Events\ExamCreated;
use App\Events\ExamUpdated;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Subject;
use App\Models\Teacher;
use App\Repositories\ExamHallRepository;
use App\Repositories\ExamRegistrationRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class TeacherExamService
{
    public function __construct(
        private readonly ExamRepositoryInterface $examRepository,
        private readonly ExamHallRepository $examHallRepository,
        private readonly ExamScheduleValidationService $scheduleValidationService
    ) {}

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

    /**
     * @throws Exception
     */
    public function createExam(CreateExamDto $dto, Teacher $teacher): Exam
    {
        $hall = $this->examHallRepository->getExamHallById($dto->hall_id);
        $startTime = $dto->start_time;
        $endTime = $dto->end_time;

        $this->scheduleValidationService->validateExamTime($hall, $startTime, $endTime, $dto->max_students);

        if ($this->examRepository->hasOverlap($hall->id, $startTime, $endTime)) {
            throw new Exception("Залата е заета през избрания интервал");
        }

        $exam = $this->examRepository->store([
            'teacher_id' => $teacher->id,
            'subject_id' => $dto->subject_id,
            'hall_id' => $dto->hall_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $dto->max_students,
            'exam_type' => $dto->exam_type,
        ]);

        event(new ExamCreated($exam));

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
    public function updateExam(int $examId, UpdateExamDto $dto): Exam
    {
        $exam = $this->examRepository->getExamById($examId);

        if ($exam->subject_id != $dto->subject_id) {
            throw new Exception("Предмета не може да бъде променян");
        }
        if ($exam->exam_type != $dto->exam_type) {
            throw new Exception('Типът на изпита не може да бъде променян');
        }

        $hall = $this->examHallRepository->getExamHallById($dto->hall_id);
        $startTime = $dto->start_time;
        $endTime = $dto->end_time;
        $now = Carbon::now();

        $oldExamStart = Carbon::parse($exam->start_time);

        if ($oldExamStart->isPast()) {
            throw new Exception("Датата на изпита е вече минала и не може да се редактира.");
        }
        if ($now->diffInHours($oldExamStart, false) <= 48) {
            throw new Exception("Изпита не може да бъде редактиран, тъй като започва след по-малко от 48 часа.");
        }

        $this->scheduleValidationService->validateExamTime($hall, $startTime, $endTime, $dto->max_students);

        if ($startTime->isPast() || $now->diffInHours($startTime, false) <= 48) {
            throw new Exception('Новият час не може да бъде насрочен в миналото или по-рано от 48 часа от текущия момент. Моля, изберете валидни дата и час.');
        }

        if ($this->examRepository->hasOverlap($hall->id, $startTime, $endTime, $exam->id)) {
            throw new Exception("Залата е заета за избрания от вас интервал от време.");
        }

        $updateData = [
            'hall_id' => $dto->hall_id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $dto->max_students,
        ];

        $newExam = $this->examRepository->update($exam, $updateData);
        event(new ExamUpdated($exam));

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

    /**
     * Актуализира оценките на студенти за даден изпит.
     * Преместена от ExamRegistrationService (teacher concern).
     */
    public function updateGrades(Teacher $teacher, int $examId, UpdateGradeDto $dto): void
    {
        $exam = $this->examRepository->getExamDetails($examId);

        if ($exam->teacher_id !== $teacher->id) {
            abort(403);
        }

        foreach ($dto->grades as $registrationId => $grade) {
            \App\Models\ExamRegistration::where('id', $registrationId)
                ->where('exam_id', $examId)
                ->update(['grade' => $grade ?: null]);
        }
    }
}
