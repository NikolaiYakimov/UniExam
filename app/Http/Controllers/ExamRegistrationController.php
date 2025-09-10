<?php

namespace App\Http\Controllers;

use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Services\ExamRegistrationService;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
class ExamRegistrationController
{
    protected $paymentService;
    protected $registrationService;

    public function __construct(PaymentService $paymentService,ExamRegistrationService $registrationService)
    {
        $this->paymentService = $paymentService;
        $this->registrationService = $registrationService;
    }

    public function myExams(): \Illuminate\Http\JsonResponse
    {
//        $student = Auth::user()->student;
//        $registeredExams = $student->registrations()
//            ->with(['exam.teacher', 'exam.subject', 'exam.hall'])
//            ->get()
//            ->pluck('exam')
//            ->sortByDesc('start_time')
//            ->values();
//
//        return view('my_exams', [
//            'exams' => $registeredExams,
//            'student' => $student
//        ]);


        $student = Auth::user()->student;
        $registeredExams = $this->registrationService->getStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function myPastExam(){
       $student = Auth::user()->student;
        $registeredExams = $this->registrationService->getPastStudentRegistrations($student);
        return view('my_past_exams', [
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function register(Request $request, Exam $exam): \Illuminate\Http\JsonResponse
    {
//        $student = Auth::user()->student;
//        $isPastSemester = $exam->subject->semester < $student->semester;
//        $hasAttestation = $student->hasAttestationForSubject($exam->subject_id);
//
//        if ($exam->remainingSlots() <= 0) {
//            return back()->with('error', 'Няма свободни места!');
//        }
//
//        if ($exam->registrations()->where('student_id', $student->id)->exists()) {
//            return back()->with('error', 'Вече сте записани за този изпит!');
//        }
//
//        if ($isPastSemester && $exam->exam_type === 'редовен') {
//            return back()->with('error', 'Не е позволено да се явяваш на редовни изпити от по-долен курс! Позволено е да се явиш само на поправката или ликвидацията на по-долния курс!');
//        }
//
//        if ($exam->exam_type === 'ликвидация' || $isPastSemester) {
//            return redirect()->route('payment.handle', ['exam' => $exam]);
//        }
//
//        ExamRegistration::create([
//            'student_id' => $student->id,
//            'exam_id' => $exam->id,
//        ]);
//
//        Mail::to(Auth::user()->email)->queue(new SuccessfullyRegistrated($exam, $student));
//        Log::info("Student registered for exam", ['student_id' => $student->id, 'exam_id' => $exam->id]);
//
//        return redirect()->route('exams')->with('success', 'Успешно се записахте за изпит!');
//        $student = Auth::user()->student;
//        $result = $this->registrationService->registerStudent($student, $exam);
//
//        if (!$result['success']) {
//            return back()->with('error', $result['message']);
//        }
//
//        if (isset($result['redirect_to_payment']) && $result['redirect_to_payment']) {
//            return redirect()->route('payment.handle', ['exam' => $exam]);
//        }
//
//        return redirect()->route('exams')->with('success', $result['message']);
        $student = Auth::user()->student;
        $result = $this->registrationService->registerStudent($student, $exam);

        if (!$result['success']) {
            return response()->json(['error' => $result['message']], 422);
        }

        if (isset($result['redirect_to_payment']) && $result['redirect_to_payment']) {
            return response()->json([
                'redirect_url' => route('payment.handle', ['exam' => $exam->id])
            ]);
        }

        return response()->json(['success' => $result['message']]);
    }

    public function unregisterExam(Exam $exam): \Illuminate\Http\JsonResponse
    {
//        $student = Auth::user()->student;
//        $isPastSemester = $exam->subject->semester < $student->semester;
//
//        $registration = ExamRegistration::where('student_id', $student->id)
//            ->where('exam_id', $exam->id)->first();
//
//        if (!$registration) {
//            return back()->with("error", "Не може да се отпишете, защото не сте записани за този изпит!");
//        }
//
//        if ($exam->start_time->isPast()) {
//            return back()->with("error", "Отписването е невъзможно, тъй като изпита вече е минал");
//        }
//
//        if ($exam->start_time->diffInHours(now(), true) < 48) {
//            return back()->with("error", "Отписването от изпита е невъзможно по-малко от 48 часа преди изпита");
//        }
//
//        if (($exam->exam_type === "ликвидация" || $isPastSemester) && $registration->payment) {
//            $refundSuccess = $this->paymentService->processRefund($registration->payment->stripe_payment_id, "requested_by_customer");
//            if (!$refundSuccess) {
//                return back()->with('error', "Грешка при връщането на парите");
//            }
//        }
//
//        $registration->delete();
//        Log::info("Student unregistered from exam", ['student_id' => $student->id, 'exam_id' => $exam->id]);
//
//        return back()->with("success", "Успешно се отписахте от изпита");
//    }

//        $student = Auth::user()->student;
//        $result = $this->registrationService->unregisterStudent($student, $exam);
//
//        if (!$result['success']) {
//            return back()->with('error', $result['message']);
//        }
//
//        return back()->with('success', $result['message']);
        $student = Auth::user()->student;
        $result = $this->registrationService->unregisterStudent($student, $exam);

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message']
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => $result['message']
        ], 200);
    }
}
