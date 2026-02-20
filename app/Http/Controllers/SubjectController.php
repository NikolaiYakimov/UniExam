<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Services\SubjectService;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SubjectController
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function getTeacherSubjects():
    JsonResponse
    {
        try {
            $teacher = Auth::user()->teacher;
            $subjects = $this->subjectService->getTeacherSubjects();

            return response()->json([
                'success' => true,
                'data' => [
                    'teacher' => $teacher,
                    'subjects' => $subjects
                ]
            ]);

        }catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'Failed to load subjects'
            ], 500);
        }
    }

    public function showSubjectStudents(Subject $subject):
    JsonResponse
    {
        try{
        $teacher = Auth::user()->teacher;
        $students = $this->subjectService->getSubjectStudents($subject->id);

        return response()->json([
            'success' => true,
            'data' => [
                'teacher' => $teacher,
                'subject' => $subject,
                'students' => $students
            ]
        ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load students'
            ], 500);
        }
    }

    public function toggleAttestation( Subject $subject, Student $student):JsonResponse
    {
        try {

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
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
