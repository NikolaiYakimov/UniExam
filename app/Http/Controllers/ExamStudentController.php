<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ExamStudentController extends Controller
{
    public function __construct(
        private readonly ExamService $examService,
    ){}

    //get registered students for the given exam
    public function index(int $examId)
    {
        try {
            $data=$this->examService->getExamWithRegisteredStudents($examId);
            return response()->json([
                'success'=>true,
                'exam'=>$data['exam'],
                'students'=>$data['students'],
            ]);
        }catch (Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json([
                'success'=>false,
                'message'=>'Грешка при зареждане на студентите'
            ]);
        }
    }
}
