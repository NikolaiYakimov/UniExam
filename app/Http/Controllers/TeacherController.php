<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\ExamHall;
use App\Models\ExamRegistration;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class TeacherController
{

    public function getTeacherProfile():  JsonResponse
    {
        $user = Auth::user();
        $teacher=$user->teacher->load('faculty','specialty');
        $subjects = $teacher->subjects()->withCount('students')->get();

        $upcomingExams = Exam::where('teacher_id', $teacher->id)
            ->where('start_time', '>', now())
            ->with('subject', 'hall')
            ->orderBy('start_time')
            ->get();


        return response()->json([
            'user'=>$user,
            'teacher'=>$teacher,
            'subjects_count' => $subjects->count(),
            'exams_count' => $upcomingExams->count(),
        ]);

    }


}
