<?php

namespace App\Http\Controllers;

use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Services\ExamRegistrationService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
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


        public function myExams(): JsonResponse

        {

            $student = Auth::user()->student;
        $registeredExams = $this->registrationService->getStudentRegistrations($student);


        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function myPastExam():JsonResponse{
       $student = Auth::user()->student;
        $registeredExams = $this->registrationService->getPastStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function register(Request $request, Exam $exam): JsonResponse

    {


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

    public function unregisterExam(Exam $exam):JsonResponse
    {

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

    public function updateGrades(Request $request, $examId)
    {
        $request->validate([
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:2|max:6'
        ]);
        try {
            $this->registrationService->updateGrades($examId, $request->grades);

            return response()->json([
                'success' => true,
                'message' => 'Оценките бяха актуализирани успешно!'
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);

        }
    }


}
