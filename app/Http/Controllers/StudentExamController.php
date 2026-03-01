<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentExamController extends Controller
{
    public function __construct(private readonly ExamService $examService){}

    public function index(Request $request):JsonResponse{
        try {
            $student=$request->user()->student;
//            $exams=$this->examService->getAvailableExams($student)->values()->all();
            $exams=$this->examService->getAvailableExams($student);

            return response()->json([
                'success' => true,
                'data' => $exams,
                'student' => $student,
            ]);
        }catch (\Exception $exception){
            Log::error('Student exams error: ' . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Възникна грешка при зареждане на изпитите',
            ],500);
        }
    }


}
