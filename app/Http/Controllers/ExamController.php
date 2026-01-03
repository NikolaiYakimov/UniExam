<?php

namespace App\Http\Controllers;


use App\Http\Requests\GetBookedSlotsRequest;
use App\Http\Requests\StoreExamRequest;
use App\Mail\ExamCreatedMail;
use App\Mail\ExamUpdatedMail;
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

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;

    }

    public function exams()
    {


        try {
            $student = Auth::user()->student;
            $exams = $this->examService->getAvailableExams($student);

            $availableExams = $exams->values()->all();
            return response()->json([
                'success' => true,
                'data' => $availableExams,
                'student' => $student,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load exams'
            ], 500);
        }
    }


    public function storeExam(StoreExamRequest $request)
    {
        try {
            $request->validated();

            $exam = $this->examService->createExam($request->all());
            $students = Student::with('user')->whereHas('user', function ($q) {
                $q->whereNotNull('email');
            })->get();

            foreach ($students as $student) {
                Mail::to($student->user->email)->queue(new ExamCreatedMail($exam));

            }
            return response()->json([
                'success' => true,
                'message' => 'Изпита е добавен успешно',
                'exam' => $exam
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function editExam(StoreExamRequest $request, int $examId)
    {
        try {
            $exam = Exam::findOrFail($examId);
            $now = Carbon::now();
            $examStart = Carbon::parse($exam->start_time);

            if ($examStart->isPast()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Датата на изпита е вече минала и не може да се редактира'
                ], 422);
            }

            if ($now->diffInHours($examStart, false) <= 48) {
                return response()->json([
                    'success' => false,
                    'message' => 'Изпита не може да бъде редактиран, тъй като започва след по-малко от 48 часа.'
                ], 422);
            }
            $validated = $request->validated();
            $this->examService->updateExam($exam, $validated);
            $registeredStudents = $exam->registrations()
                ->with('student.user')
                ->get()
                ->pluck('student.user')
                ->filter();

            foreach ($registeredStudents as $user) {
                if ($user->email) {
                    Mail::to($user->email)->queue(new ExamUpdatedMail($exam));
                }
            }


            return response()->json([
                'success' => true,
                'message' => 'Изпита беше редактиран успешно!',
                'data' => $exam
            ]);

        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function getExamEditData($examId): \Illuminate\Http\JsonResponse
    {
        try {
            $exam = Exam::findOrFail($examId);
            return response()->json([
                'subject_id' => $exam->subject_id,
                'exam_type' => $exam->exam_type,
                'max_students' => $exam->max_students,
                'start_time' => $exam->start_time,
                'end_time' => $exam->end_time,
                'hall_id' => $exam->hall_id
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Грешка при зареждане на запазените часове ',
                'message' => $exception->getMessage()
            ], 500);
        }
    }


    public function getBookedSlots(GetBookedSlotsRequest $request)
    {
        try {

            $excludeExamId = $request->input('exclude_exam_id', null);

            $slots = $this->examService->getBookedSlots($request->hall_id, $request->date, $excludeExamId);


            return response()->json([
                'bookedSlots' => $slots->map(function ($exam) {
                    return [
                        'id' => $exam->id,
                        'hall_id' => $exam->hall_id,
                        'start' => $exam->start_time->toIso8601String(),
                        'end' => $exam->end_time->toIso8601String()
                    ];
                })->filter(),
                'date' => $request->date,
                'hall_id' => $request->hall_id,
                'count' => $slots->count(),
                'timestamp' => now()->toIso8601String()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'Грешка при зареждане на запазените часове ',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function teacherUpcomingExams(): JsonResponse
    {
        try {
            $teacher = Auth::user()->teacher;
            $exams = $this->examService->getUpcomingExams($teacher)->load('subject', 'hall');


            $subjects = $teacher->subjects;
            $halls = ExamHall::all();



            return response()->json([
                "exams" => $exams,
                "teacher" => $teacher,
                "subjects" => $subjects,
                "halls" => $halls,

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Грешка при зареждане на предстоящите изпити ',
                'message' => 'Failed to load upcoming exams'
            ], 500);
        }
    }

    public function examRegisteredStudents($examId): JsonResponse
    {
        try {

            $exam = Exam::with(['subject', 'registrations.student.user'])->findOrFail($examId);

            $students = $exam->registrations->map(function ($registration) {
                if ($registration->student) {
                    return [
                        'id' => $registration->student->id,
                        'first_name' => $registration->student->user->first_name,
                        'second_name' => $registration->student->user->second_name,
                        'last_name' => $registration->student->user->last_name,
                        'faculty_number' => $registration->student->faculty_number,
                        'email' => $registration->student->user->email,
                    ];
                }
                return null;
            })->filter();

            return response()->json([
                'success' => true,
                'exam' => [
                    'id' => $examId,
                    'subject_name' => $exam->subject->subject_name,
                    'exam_type' => $exam->exam_type,
                    'start_time' => $exam->start_time->toIso8601String(),
                ],
                'students' => $students
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Има грешка брато"
            ], 404);
        }
    }

    public function conductedExams():
    JsonResponse
    {
        try {
            $teacher = Auth::user()->teacher;
            $exams = $this->examService->getConductedExams();
            $subjects = Subject::all();
            $halls = ExamHall::all();

            return response()->json([
                'success' => true,
                'data' => [
                    'teacher' => $teacher,
                    'exams' => $exams,
                    'subjects' => $subjects,
                    'halls' => $halls
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load conducted exams'
            ], 500);
        }
    }

    public function examDetails($examId):
    JsonResponse
    {
        try {

            $exam = $this->examService->getExamDetails($examId);
            $teacher = Auth::user()->teacher;

            return response()->json([
                'success' => true,
                'data' => [
                    'exam' => $exam,
                    'teacher' => $teacher
                ]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found'
            ], 404);

        }
    }

}
