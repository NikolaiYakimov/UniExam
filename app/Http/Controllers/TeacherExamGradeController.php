<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpgradeGradeRequest;
use App\Services\ExamRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherExamGradeController extends Controller
{

    public function __construct(private readonly ExamRegistrationService $examRegistrationService,)
    {
    }

    public function update(UpgradeGradeRequest $request, $examId): JsonResponse
    {

        $request->validated();
        try {
            $this->examRegistrationService->updateGrades($request, $examId);
            return response()->json([
                'success' => true,
                'message' => 'Оценките бяха актуализирани успешно!'
                ]
            );
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }

    }
}
