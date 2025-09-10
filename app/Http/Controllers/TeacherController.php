<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\ExamRegistration;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class TeacherController
{
    // Добавяме следните методи
    // Добавяме следните методи
    public function subjects(): View
    {
        $teacher = Auth::user()->teacher;
        $subjects = $teacher->subjects()->withCount('students')->get();

        return view('teacher_subjects', compact('teacher', 'subjects'));
    }

    public function subjectStudents(Subject $subject): View
    {
        $teacher = Auth::user()->teacher;

        // Проверка дали учителят преподава този предмет
        if (!$teacher->subjects->contains($subject)) {
            abort(403);
        }

        $students = $subject->students()
            ->with('user', 'specialty')
            ->orderBy('faculty_number')
            ->get();

        return view('teacher_subject_students', compact('teacher', 'subject', 'students'));
    }

    public function toggleAttestation(Request $request, Subject $subject, Student $student)
    {
        $teacher = Auth::user()->teacher;

        // Проверка дали учителят преподава този предмет
        if (!$teacher->subjects->contains($subject)) {
            abort(403);
        }

        // Проверка дали студента е записан по предмета
        if (!$subject->students->contains($student)) {
            abort(404);
        }

        // Превключваме заверката
        $hasAttestation = $subject->students()
            ->where('student_id', $student->id)
            ->first()
            ->pivot
            ->has_attestation;

        $subject->students()->updateExistingPivot($student->id, [
            'has_attestation' => !$hasAttestation
        ]);

        return response()->json([
            'success' => true,
            'has_attestation' => !$hasAttestation
        ]);
    }

    public function dashboard():View{
        $teacher = Auth::user()->teacher;
        $exams= Exam::where('teacher_id',$teacher->id)
            ->where('start_time','>',now())
            ->orderBy('start_time', 'desc')
            ->get();
//            ->sortByDesc('start_time')
//            ->values();
        $subjects = Subject::all();
        $halls=ExamHall::all();
        $bookedSlots = Exam::all()->map(function($exam) {
            return [
                'hall_id' => $exam->hall_id,
                'start' => Carbon::parse($exam->start_time)->toIso8601String(),
                'end' => Carbon::parse($exam->end_time) ->toIso8601String(),
                'title' => 'Заето'
            ];
        });

        return view('teacher_dashboard',compact('teacher','exams','subjects','halls','bookedSlots'));
    }

    public function conductedExams():View{
        $teacher=Auth::user()->teacher;
        $exams= Exam::where('teacher_id',$teacher->id)
            ->where('start_time','<',Carbon::now()->toIso8601String())
            ->orderBy('start_time', 'desc')
            ->get();
//        ->sortByDesc('start_time');
        $subjects = Subject::all();
        $halls=ExamHall::all();
        return view('teacher_conducted_exams',compact('teacher','exams','subjects','halls'));
    }
    public function examDetails($examId)
    {
        $exam=Exam::with(['registrations.student.user','subject'])->findOrFail($examId);
        $teacher=Auth::user()->teacher;
        if($exam->teacher_id!==$teacher->id){
            abort(403);
        }

        return view('teacher_exam_details',compact('exam','teacher'));

    }

    public function updateGrades(Request $request,$examId)
    {
        $exam=Exam::findOrFail($examId);
        $teacher=Auth::user()->teacher;

        if($exam->teacher_id!==$teacher->id){
            abort(403);
        }

        $request->validate([
            'grades'=>'required|array',
            'grades.*'=>'nullable|numeric|min:2|max:6'
        ]);

        foreach($request->grades as $registrationId=>$grade){
            $registration=ExamRegistration::find($registrationId);
            if($registration && $registration->exam_id==$examId){
                $registration->grade=$grade?:null;
                $registration->save();
            }
        }

        return back()->with('success', 'Оценките бяха актуализирани успешно!');
    }


}
