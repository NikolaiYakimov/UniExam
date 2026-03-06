<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ExamRegistrationRepository;
use App\Repositories\ExamRepository;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfullyRegistrated;

class ExamRegistrationService
{
    public function __construct(
        private readonly ExamRegistrationRepository $registrationRepository,
        private readonly ExamRepository $examRepository,
        private readonly PaymentService $paymentService
    ) {}

    public function getActiveStudentRegistrations(Student $student)
    {
        return $this->registrationRepository->getActiveStudentRegistrations($student);
    }

    public function getPastStudentRegistrations(Student $student)
    {
        return $this->registrationRepository->getPastStudentRegistrations($student);

    }

    public function registerStudent(Student $student, int $examId): array
    {
        $exam=$this->examRepository->getExamById($examId);
        if ($exam->remainingSlots() <= 0) {
            throw new Exception("Няма свободни места");
        }

        if ($this->registrationRepository->checkExistingRegistration($student->id, $exam->id)) {
            throw new Exception("Вече сте записани за този изпит!");
        }

        $isPastSemester = $exam->subject->semester < $student->semester;

        if ($isPastSemester && $exam->exam_type === 'редовен') {

            throw new Exception('Не е позволено да се явяваш на редовни изпити от по-долен курс! Позволено е да се явиш само на поправката или ликвидацията на по-долния курс!');
        }


        if ($exam->exam_type === 'ликвидация' || $isPastSemester) {
            return ['redirect_to_payment'=>true];
        }

        $this->registrationRepository->createRegistration([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
        ]);

        // Изпращане на имейл
        Mail::to($student->user->email)->queue(new SuccessfullyRegistrated($exam, $student));


        return ['redirect_to_payment'=>false];
    }

    public function unregisterStudent(Student $student, int $examId): void
    {
        $exam=$this->examRepository->getExamById($examId);
        $registration = $this->registrationRepository->findRegistration($student->id, $exam->id);

        if (!$registration) {
            throw new Exception('Не може да се отпишете, защото не сте записани за този изпит!');
        }

        if ($exam->start_time->isPast()) {
            throw new Exception('Отписването е невъзможно, тъй като изпита вече е минал.');
        }

        if ($exam->start_time->diffInHours(now(), true) < 48) {
            throw new Exception('Отписването от изпита е невъзможно по-малко от 48 часа преди изпита.');
        }

        $isPastSemester = $exam->subject->semester < $student->semester;

        if (($exam->exam_type === "ликвидация" || $isPastSemester) && $registration->payment) {
            $refundSuccess = $this->paymentService->processRefund(
                $registration->payment->stripe_payment_id,
                "requested_by_customer"
            );

            if (!$refundSuccess) {
                throw new Exception('Възникна грешка при възстановяването на сумата.');
            }

        }

        $this->registrationRepository->deleteRegistration($registration);



    }

    public function updateGrades(Teacher $teacher,$examId, $grades)
    {
        $exam=$this->examRepository->getExamDetails($examId);

        if ($exam->teacher_id !== $teacher->id) {
            abort(403);
        }
        $this->registrationRepository->updateExamGrades($examId, $grades);
    }



}
