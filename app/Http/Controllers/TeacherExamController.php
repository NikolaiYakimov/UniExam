<?php

namespace App\Http\Controllers;

use App\DTOs\CreateExamDto;
use App\DTOs\UpdateExamDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Http\Resources\ExamDetailsResource;
use App\Http\Resources\ExamEditResource;
use App\Http\Resources\ExamListResource;
use App\Services\Exam\TeacherExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class TeacherExamController extends Controller
{
    public function __construct(private readonly TeacherExamService $examService)
    {
    }

    //Showing upcoming exams
    public function upcomingExam(Request $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;

            $data = $this->examService->getTeacherDashboardData($teacher);
            $data['exams'] = ExamListResource::collection($data['exams']);

            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'error' => 'Грешка при зареждане на предстоящите изпити ',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    //Creating new exam
    public function store(StoreExamRequest $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $dto = CreateExamDto::fromRequest($request);
            $exam = $this->examService->createExam($dto, $teacher);

            return response()->json([
                'success' => true,
                'message' => 'Изпита е добавен успешно',
                'exam' => new ExamDetailsResource($exam),
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    //Get exam details with grades
    public function show(Request $request, int $examId): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $exam = $this->examService->getExamDetailsForTeacher($examId, $teacher);

            return response()->json([
                'success' => true,
                'data' => [
                    'exam' => new ExamDetailsResource($exam),
                    'teacher' => $teacher,
                ]
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 404);
        }
    }

    //Exam Details from ExamController
    //Get data for the edit exam
    public function edit(Request $request, int $examId): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $exam = $this->examService->getExamForEdit($examId, $teacher->id);

            return response()->json(new ExamEditResource($exam));
        } catch (\Exception $exception) {

            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
            'message'=>$exception->getMessage()
            ], 500);

        }
    }

    //Update existing exam
    public function update(StoreExamRequest $request, int $examId): JsonResponse
    {
        try {
            $dto = UpdateExamDto::fromRequest($request);
            $updatedExam = $this->examService->updateExam($examId, $dto);

            return response()->json([
                'success' => true,
                'message' => 'Изпита беше редактиран успешно!',
                'data' => new ExamDetailsResource($updatedExam)
            ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message'=>$exception->getMessage()
            ],422);
        }
    }

    //Get conducted exams
    public function conducted(Request $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $data = $this->examService->getConductedExams($teacher);
            $data['exams'] = ExamListResource::collection($data['exams']);

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success'=>false,
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
