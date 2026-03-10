<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Student;
use App\Services\ExamRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherGradeController extends Controller
{
    public function __construct(
        private readonly examRegistrationService $examRegistrationService,
    ){}

    //Update Students grades, if there is any change
    public function update(UpdateGradeRequest $request,int $examId):JsonResponse
    {
        try {
            $teacher=$request->user()->teacher;
           $request->validated();
            $this->examRegistrationService->updateGrades($teacher,$examId, $request->grades);

            return response()->json([
                'success' => true,
                'message' => 'Оценките бяха актуализирани успешно!'
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);

        }
    }
}
