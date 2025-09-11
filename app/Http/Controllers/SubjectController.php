<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\SubjectService;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SubjectController
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function getTeacherSubjects():
//    JsonResponse
    View
    {
//        try {
            $teacher = Auth::user()->teacher;
            $subjects = $this->subjectService->getTeacherSubjects();

            return view('teacher_subjects', compact('teacher', 'subjects'));
//            return response()->json([
//                'success' => true,
//                'data' => [
//                    'teacher' => $teacher,
//                    'subjects' => $subjects
//                ]
//            ]);

//        }catch (\Exception $exception){
//            return response()->json([
//                'success' => false,
//                'message' => 'Failed to load subjects'
//            ], 500);
//        }
    }

    public function showSubjectStudents(Subject $subject):
//    JsonResponse
    View
    {
//        try{
        $teacher = Auth::user()->teacher;
        $students = $this->subjectService->getSubjectStudents($subject->id);

        return view('teacher_subject_students', compact('teacher', 'subject', 'students'));
//        return response()->json([
//            'success' => true,
//            'data' => [
//                'teacher' => $teacher,
//                'subject' => $subject,
//                'students' => $students
//            ]
//        ]);
//        }catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Failed to load students'
//            ], 500);
//        }
    }

    public function toggleAttestation(Request $request, Subject $subject, Student $student):JsonResponse
    {
//        try {

        $hasAttestation = $subject->students()
            ->where('student_id', $student->id)
            ->first()
            ->pivot
            ->has_attestation;

        $newStatus = $this->subjectService->toggleAttestation(
            $subject->id,
            $student->id,
            $hasAttestation
        );

        return response()->json([
            'success' => true,
            'has_attestation' => $newStatus
        ]);
//        }catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'message' => $e->getMessage()
//            ], 500);
//        }
    }
}
