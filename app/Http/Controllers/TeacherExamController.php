<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Services\ExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class TeacherExamController extends Controller
{
    public function __construct(private readonly ExamService $examService)
    {
    }

    //Showing upcoming exams
    public function upcomingExam(Request $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;

            $data = $this->examService->getTeacherDashboardData($teacher);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Грешка при зареждане на предстоящите изпити ',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //Creating new exam
    public function store(StoreExamRequest $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $exam = $this->examService->createExam($request->validated(), $teacher);
            return response()->json([
                'success' => true,
                'message' => 'Изпита е добавен успешно',
                'exam' => $exam,
            ]);
        } catch (\Exception $exception) {
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
            Log::info($exam);
            return response()->json([
                'success' => true,
                'data' => [
                    'exam' => $exam,
                    'teacher' => $teacher,
                ]
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Exam not found"
            ], 404);
        }
    }

    //Exam Details from ExamController
    //Get data for the edit exam
    public function edit(Request $request, int $examId): JsonResponse
    {
        try {
        $teacher = $request->user()->teacher;
        $exam = $this->examService->getExamForEdit($examId,$teacher->id);

            return response()->json([
                'subject_id' => $exam->subject_id,
                'exam_type' => $exam->exam_type,
                'max_students' => $exam->max_students,
                'start_time' => $exam->start_time,
                'end_time' => $exam->end_time,
                'hall_id' => $exam->hall_id
            ]);
        }catch (\Exception $exception){

            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при зареждането на изпита',
            ], 500);

        }
    }

    //Update existing exam
    public function update(StoreExamRequest $request, int $examId): JsonResponse
    {
        try {
            $updatedExam = $this->examService->updateExam($examId,$request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Изпита беше редактиран успешно!',
                'data' => $updatedExam
            ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage());
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
          $teacher=$request->user()->teacher;
          $data=$this->examService->getConductedExams($teacher);
          return response()->json([
              'success'=>true,
              'data'=>$data
          ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return response()->json([
                'success'=>false,
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
