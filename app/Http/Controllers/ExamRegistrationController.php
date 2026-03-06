<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGradeRequest;
use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Services\ExamRegistrationService;
use App\Services\PaymentService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ExamRegistrationController
{

    public function __construct(
        private readonly ExamRegistrationService $registrationService
    ){}

    public function myExams(Request $request): JsonResponse

    {
        $student = $request->user()->student;
        $registeredExams = $this->registrationService->getActiveStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function pastExam(): JsonResponse
    {
        $student = Auth::user()->student;
        $registeredExams = $this->registrationService->getPastStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    public function register(Request $request, int $examId): JsonResponse
    {
        try {
            $student = $request->user()->student;
            $result = $this->registrationService->registerStudent($student, $examId);
            if ($result['redirect_to_payment']) {
                return response()->json([
                    'redirect_url' => route('payment.handle', ['examId' => $examId])
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Успешно се записахте за изпит!'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    public function unregisterExam(Request $request, int $examId): JsonResponse
    {
        try {
            $student = $request->user()->student;
            $this->registrationService->unregisterStudent($student, $examId);
            return response()->json([
                'success' => true,
                'message' => 'Успешно се отписахте от изпита'
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

    }

}
