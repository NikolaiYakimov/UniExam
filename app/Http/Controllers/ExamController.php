<?php

namespace App\Http\Controllers;



use App\Http\Requests\GetBookedSlotsRequest;
use App\Http\Requests\StoreExamRequest;
use App\Mail\ExamCreatedMail;
use App\Models\Student;
use App\Services\ExamService;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use function Webmozart\Assert\Tests\StaticAnalysis\email;
use App\Http\Controllers\Controller;

use Illuminate\View\View;

class   ExamController extends Controller
{


    protected $examService;

    public function __construct(ExamService $examService){
        $this->examService=$examService;

    }
    public function exams()
    {
        $student = Auth::user()->student;
        $exams = $this->examService->getAvailableExams($student);

        return view('exams', compact('exams'));
//        try {
//            $student = Auth::user()->student;
//            $exams = $this->examService->getAvailableExams($student);
//
//            return response()->json([
//                'success' => true,
//                'data' => $exams
//            ]);
//        } catch (\Exception $e) {
//            return response()->json([
//                'success' => false,
//                'message' => 'Failed to load exams'
//            ], 500);
//        }
    }
    public function storeExam(StoreExamRequest $request){
        try {
            $request->validated();

            $exam=$this->examService->createExam($request->all());
            $students=Student::with('user')->whereHas('user',function ($q){
                $q->whereNotNull('email');
            })->get();

            foreach($students as $student){
                    Mail::to($student->user->email)->queue(new ExamCreatedMail($exam));

            }
            return back()->with('success','Изпита е добавен успешно');
//            return response()->json([
//                'success' => true,
//                'message' => 'Изпита е добавен успешно',
//                'exam' => $exam
//            ]);

        }catch (\Exception $exception){
//            return back()->with('error',$exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
    public function editExam(StoreExamRequest $request,int $examId)
    {
        try{
            $exam=Exam::findOrFail($examId);
            $now=Carbon::now();
            $examStart=Carbon::parse($exam->start_time);
//            Log::debug($examStart);
//            Log::debug($now);
//            Log::debug($examStart->diffInHours($now));

//            \Log::debug("Current time: " . $now);
//            \Log::debug("Exam start: " . $examStart);
//            \Log::debug("Hours difference: " . $now->diffInHours($examStart, false));
            if($examStart->isPast()){
                throw new \Exception('Датата на изпита е вече минала и не може да се редактира');
//                return response()->json([
//                    'success' => false,
//                    'message' => 'Датата на изпита е вече минала и не може да се редактира'
//                ], 422);
            }

            if($now->diffInHours($examStart,false)<=48){
                throw new Exception('Изпита не може да бъде редактиран, тъй като започва след по-малко от 48 часа.');
//                return response()->json([
//                    'success' => false,
//                    'message' => 'Изпита не може да бъде редактиран, тъй като започва след по-малко от 48 часа.'
//                ], 422);
            }
            $validated=$request->validated();
            $this->examService->updateExam($exam,$validated);
            return back()->with('success','Изпита беше редактиран успешно!');
//            return response()->json([
//                'success' => true,
//                'message' => 'Изпита беше редактиран успешно!',
//                'data' => $exam
//            ]);

        }catch (Exception $exception){
            return back()->with('error',$exception->getMessage());
//            return response()->json([
//                'success' => false,
//                'message' => $exception->getMessage()
//            ], 500);
        }
    }

    public function getExamEditData($examId): \Illuminate\Http\JsonResponse
    {
        $exam=Exam::findOrFail($examId);
        return response()->json([
            'subject_id'=>$exam->subject_id,
            'exam_type'=>$exam->exam_type,
            'max_students'=>$exam->max_students,
            'start_time'=>$exam->start_time,
            'end_time'=>$exam->end_time,
            'hall_id'=>$exam->hall_id
        ]);
    }


    public function getBookedSlots(GetBookedSlotsRequest $request){
        try {
            $excludeExamId = $request->input('exclude_exam_id', null);
            $slots=$this->examService->getBookedSlots($request->hall_id,$request->date,$excludeExamId);

            return response()->json([
                'bookedSlots'=>$slots->map(function($exam){
                   return[
                       'id'=>$exam->id,
                       'hall_id'=>$exam->hall_id,
                       'start' => $exam->start_time->toIso8601String(),
                       'end' => $exam->end_time->toIso8601String()
                   ] ;
                })->filter(),
                'date'=>$request->date,
                'hall_id'=>$request->hall_id,
                'count'=>$slots->count(),
                'timestamp'=>now()->toIso8601String()
            ]);
        }catch (\Exception $exception){
            \Log::error('Booked slots error', [
                'method' => __METHOD__,
                'params' => $request->all(),
                'error' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ]);
            return response()->json([
                'error'=>'Грешка при зареждане на запазените часове ',
                'message'=>$exception->getMessage()
            ],500);
        }
    }

    public function teacherUpcomingExams():
//    JsonResponse
    View
    {
//        try {
            $teacher = Auth::user()->teacher;
            $exams = $this->examService->getUpcomingExams($teacher);
            $subjects = Subject::all();
            $halls = ExamHall::all();
//        $bookedSlots = $this->examService->getBookedTimeSlots();

//        return view('teacher_dashboard', compact('teacher', 'exams', 'subjects', 'halls', 'bookedSlots'));
        return view('teacher_dashboard', compact('teacher', 'exams', 'subjects', 'halls'));

//            return response()->json([
//                "exams"=>$exams,
//                "teacher"=>$teacher,
//                "subjects"=>$subjects,
//                "halls"=>$halls,
//            ]);
//        }catch (\Exception $e){
//            return response()->json([
//                'message' => 'Failed to load upcoming exams'
//            ], 500);
//        }
    }

    public function conductedExams():
//    JsonResponse
    View
    {
//        try {
            $teacher = Auth::user()->teacher;
            $exams = $this->examService->getConductedExams();
            $subjects = Subject::all();
            $halls = ExamHall::all();

        return view('teacher_conducted_exams', compact('teacher', 'exams', 'subjects', 'halls'));
//            return response()->json([
//                'success' => true,
//                'data' => [
//                    'teacher' => $teacher,
//                    'exams' => $exams,
//                    'subjects' => $subjects,
//                    'halls' => $halls
//                ]
//            ]);
//        }catch (\Exception $exception){
//            Log::error($exception->getMessage());
//            return response()->json([
//                'success' => false,
//                'message' => 'Failed to load conducted exams'
//            ], 500);
//        }
    }

    public function examDetails($examId):
//    JsonResponse
    View
    {
//        try {

            $exam = $this->examService->getExamDetails($examId);
            $teacher = Auth::user()->teacher;

            return view('teacher_exam_details', compact('exam', 'teacher'));
//            return response()->json([
//                'success' => true,
//                'data' => [
//                    'exam' => $exam,
//                    'teacher' => $teacher
//                ]
//            ]);

//        }catch (\Exception $exception){
////            return response()->json([
////                'success' => false,
////                'message' => 'Exam not found'
////            ], 404);
//
//        }
    }
    public function updateGrades(Request $request, $examId)
    {
        $request->validate([
            'grades' => 'required|array',
            'grades.*' => 'nullable|numeric|min:2|max:6'
        ]);
            try {
                $this->examService->updateGrades($examId, $request->grades);

                return back()->with('success', 'Оценките бяха актуализирани успешно!');
//                return response()->json([
//                    'success' => true,
//                    'message' => 'Оценките бяха актуализирани успешно!'
//                ]);
            }catch (\Exception $exception){
//                return response()->json([
//                    'success' => false,
//                    'message' => $exception->getMessage()
//                ], 500);
                return back()->with('error',$exception->getMessage());
            }
    }

}
