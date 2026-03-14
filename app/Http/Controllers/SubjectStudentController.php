<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectStudentController extends Controller
{
    public function __construct(private readonly SubjectService $subjectService)
    {
    }

    public function index(Request $request, int $subjectId): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $subject = $this->subjectService->getSubjectById($subjectId);
            $students = $this->subjectService->getSubjectStudents($subjectId, $teacher);
            return response()->json([
                'success' => true,
                'data' => [
                    'subject' => $subject,
                    'students' => $students
                ]
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " |||| " . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 403);
        }
    }

}
