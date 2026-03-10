<?php
//
//namespace App\Http\Controllers;
//
//use App\Http\Controllers\Controller;
//use App\Services\SubjectService;
//
//use App\Models\Subject;
//use App\Models\Student;
//use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Log;
//
//class SubjectController
//{
//
//    public function __construct(private readonly SubjectService $subjectService){}
//
//    public function getTeacherSubjects(Request $request): JsonResponse
//    {
//        try {
//            $teacher = $request->user()->teacher;
//            $subjects = $this->subjectService->getTeacherSubjects($teacher->id);
//
//            return response()->json([
//                'success' => true,
//                'subjects' => $subjects
//            ]);
//
//        } catch (\Exception $e) {
//            Log::error($e->getMessage() . " |||| " . $e->getTraceAsString());
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage()
//            ], 500);
//        }
//    }
//
//    public function showSubjectStudents(Request $request, int $subjectId):
//    JsonResponse
//    {
//        try {
//            $teacher = $request->user()->teacher;
//            $subject = $this->subjectService->getSubjectById($subjectId);
//            $students = $this->subjectService->getSubjectStudents($subjectId, $teacher);
//            return response()->json([
//                'success' => true,
//                'data' => [
//                    'subject' => $subject,
//                    'students' => $students
//                ]
//            ]);
//        } catch (\Exception $e) {
//            Log::error($e->getMessage() . " |||| " . $e->getTraceAsString());
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage()
//            ], 403);
//        }
//    }
//
//    public function toggleAttestation(Request $request, int $subjectId, int $studentId): JsonResponse
//    {
//        try {
//            $teacher = $request->user()->teacher;
//            $newStatus = $this->subjectService->toggleAttestation($subjectId, $studentId, $teacher);
//
//            return response()->json([
//                'success' => true,
//                'has_attestation' => $newStatus
//            ]);
//        } catch (\Exception $e) {
//            Log::error($e->getMessage() . " |||| " . $e->getTraceAsString());
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage()
//            ], 500);
//        }
//    }
//}
