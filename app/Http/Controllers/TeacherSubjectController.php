<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherSubjectController extends Controller
{
    public function __construct(
        private readonly SubjectService $subjectService)
    {}

    public function index(Request $request): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $subjects = $this->subjectService->getTeacherSubjects($teacher->id);

            return response()->json([
                'success' => true,
                'subjects' => $subjects
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage() . " |||| " . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
