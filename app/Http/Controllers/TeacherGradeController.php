<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateGradeDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGradeRequest;
use App\Services\Exam\TeacherExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherGradeController extends Controller
{
    public function __construct(
        private readonly TeacherExamService $teacherExamService,
    ){}

    //Update Students grades, if there is any change
    public function update(UpdateGradeRequest $request,int $examId):JsonResponse
    {
        try {
            $teacher=$request->user()->teacher;
            $dto = UpdateGradeDto::fromRequest($request);
            $this->teacherExamService->updateGrades($teacher,$examId, $dto);

            return response()->json([
                'success' => true,
                'message' => 'Оценките бяха актуализирани успешно!'
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);

        }
    }
}
