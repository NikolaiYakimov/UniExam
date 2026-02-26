<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\ExamHall;
use App\Models\ExamRegistration;
use App\Models\Subject;
use App\Repositories\ExamRepository;
use App\Services\TeacherService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class TeacherController extends Controller
{
    public function getTeacherProfile(Request $request,TeacherService $teacherService):  JsonResponse
    {
//        $user = Auth::user();
//        $teacher=$user->teacher->load('faculty','specialty');
//        $subjects = $teacher->subjects()->withCount('students')->get();
//
//        $upcomingExams =$this->examRepository->getTeacherUpcomingExams($teacher->id);
//
//        return response()->json([
//            'user'=>$user,
//            'teacher'=>$teacher,
//            'subjects_count' => $subjects->count(),
//            'exams_count' => $upcomingExams->count(),
//        ]);
        $data=$teacherService->getTeacherData($request->user());
        return response()->json($data);
    }


}
