<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentAttestationController extends Controller
{
    public function __construct(private readonly SubjectService $subjectService)
    {
    }

    public function update(Request $request, int $subjectId, int $studentId): JsonResponse
    {
        try {
            $teacher = $request->user()->teacher;
            $newStatus = $this->subjectService->toggleAttestation($subjectId, $studentId, $teacher);

            return response()->json([
                'success' => true,
                'has_attestation' => $newStatus
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
