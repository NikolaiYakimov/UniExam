<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Exam\StudentExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentExamController extends Controller
{
    public function __construct(private readonly StudentExamService $examService){}

    //Get all available exams for the student
    public function index(Request $request):JsonResponse{
        try {
            $student=$request->user()->student;
            $exams=$this->examService->getAvailableExams($student);

            return response()->json([
                'success' => true,
                'data' => $exams,
                'student' => $student,
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Възникна грешка при зареждане на изпитите',
            ],500);
        }
    }


}
