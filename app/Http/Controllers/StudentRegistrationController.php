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


class StudentRegistrationController extends Controller
{

    public function __construct(
        private readonly ExamRegistrationService $registrationService
    )
    {
    }

    //Return active exams of the student
    public function myExams(Request $request): JsonResponse

    {
        $student = $request->user()->student;
        $registeredExams = $this->registrationService->getActiveStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    //Return the past exams of the student
    public function pastExam(Request $request): JsonResponse
    {
        $student = $request->user()->student;
        $registeredExams = $this->registrationService->getPastStudentRegistrations($student);

        return response()->json([
            'exams' => $registeredExams,
            'student' => $student
        ]);
    }

    //Register student for exam, if the exam required payment return url to stripe payment page
    public function store(Request $request, int $examId): JsonResponse
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
        } catch (Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'error' => $exception->getMessage(),
                'success' => false,
                'message'=>$exception->getMessage()
            ], 422);
        }
    }

    //Unregister student of a given exam, if he is registered
    public function destroy(Request $request, int $examId): JsonResponse
    {
        try {
            $student = $request->user()->student;
            $this->registrationService->unregisterStudent($student, $examId);
            return response()->json([
                'success' => true,
                'message' => 'Успешно се отписахте от изпита'
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json(['success' => false,
                'message' => $exception->getMessage()], 400);
        }

    }

}
