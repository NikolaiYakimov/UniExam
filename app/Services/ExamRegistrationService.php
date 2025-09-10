<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\Student;
use App\Repositories\ExamRegistrationRepository;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfullyRegistrated;

class ExamRegistrationService
{
    protected $registrationRepository;
    protected $paymentService;

    public function __construct(
        ExamRegistrationRepository $registrationRepository,
        PaymentService $paymentService
    ) {
        $this->registrationRepository = $registrationRepository;
        $this->paymentService = $paymentService;
    }

    public function getStudentRegistrations(Student $student)
    {
        return $this->registrationRepository->getStudentRegistrations($student);
    }

    public function getPastStudentRegistrations(Student $student)
    {
        return $this->registrationRepository->getPastStudentRegistrations($student);

    }

    public function registerStudent(Student $student, Exam $exam): array
    {
        if ($exam->remainingSlots() <= 0) {
            return ['success' => false, 'message' => 'Няма свободни места!'];
        }

        if ($this->registrationRepository->checkExistingRegistration($student->id, $exam->id)) {
            return ['success' => false, 'message' => 'Вече сте записани за този изпит!'];
        }

        $isPastSemester = $exam->subject->semester < $student->semester;

        if ($isPastSemester && $exam->exam_type === 'редовен') {
            return [
                'success' => false,
                'message' => 'Не е позволено да се явяваш на редовни изпити от по-долен курс! Позволено е да се явиш само на поправката или ликвидацията на по-долния курс!'
            ];
        }


        if ($exam->exam_type === 'ликвидация' || $isPastSemester) {
            return ['success' => true, 'redirect_to_payment' => true];
        }


        $this->registrationRepository->createRegistration([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
        ]);

        // Изпращане на имейл
        Mail::to($student->user->email)->queue(new SuccessfullyRegistrated($exam, $student));


        return ['success' => true, 'message' => 'Успешно се записахте за изпит!'];
    }

    public function unregisterStudent(Student $student, Exam $exam): array
    {
        $registration = $this->registrationRepository->findRegistration($student->id, $exam->id);

        if (!$registration) {
            return ['success' => false, 'message' => 'Не може да се отпишете, защото не сте записани за този изпит!'];
        }

        if ($exam->start_time->isPast()) {
            return ['success' => false, 'message' => 'Отписването е невъзможно, тъй като изпита вече е минал'];
        }

        if ($exam->start_time->diffInHours(now(), true) < 48) {
            return ['success' => false, 'message' => 'Отписването от изпита е невъзможно по-малко от 48 часа преди изпита'];
        }

        $isPastSemester = $exam->subject->semester < $student->semester;

        if (($exam->exam_type === "ликвидация" || $isPastSemester) && $registration->payment) {
            $refundSuccess = $this->paymentService->processRefund(
                $registration->payment->stripe_payment_id,
                "requested_by_customer"
            );

            if (!$refundSuccess) {
                return ['success' => false, 'message' => 'Грешка при връщането на парите'];
            }
        }

        $this->registrationRepository->deleteRegistration($registration);



        return ['success' => true, 'message' => 'Успешно се отписахте от изпита'];
    }
}
