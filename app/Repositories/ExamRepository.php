<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Student;
use App\Repositories\ExamRepositoryInterface;
use Illuminate\Support\Collection;

class ExamRepository implements ExamRepositoryInterface
{

    public function hasOverlap($hallId, $startTime, $endTime)
    {
        return Exam::where('hall_id',$hallId)->
            where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)->
                    where('end_time', '>', $startTime);
        })->exists();

    }

    public function store($data):Exam
    {
       return Exam::create($data);

    }

    public function getBookedSlots($hallId, $startTime, $endTime,$excludeExamId=null)
    {
        $query= Exam::where('hall_id',$hallId)->
            where(function ($query) use ($startTime, $endTime) {
                $query->where('end_time', '>', $startTime)
                    ->where('start_time', '<', $endTime);
        });
        if($excludeExamId){
            $query->where('id','!=',$excludeExamId);
        }

        return $query->get();
    }

    public function getExamsForStudent(Student $student): Collection
    {
        $registeredExamIds = $student->registrations()->pluck('exam_id');

        return Exam::with(['teacher', 'subject'])
            ->whereHas('subject', function ($q) use ($student) {
                $q->where('semester', '<=', $student->semester)
                    ->whereHas('specialties', function ($q) use ($student) {
                        $q->where('specialty_id', $student->specialty_id);
                    });
            })
            ->where('start_time', '>', now())
            ->whereNotIn('id', $registeredExamIds)
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function getRegisteredExams(Student $student): Collection
    {
        return $student->registrations()
            ->with(['exam.teacher', 'exam.subject', 'exam.hall'])
            ->get()
            ->pluck('exam')
            ->sortByDesc('start_time')
            ->values();
    }

    public function getExamById(int $id): ?Exam
    {
        return Exam::with(['teacher', 'subject', 'hall'])->find($id);
    }

    public function getExamsBySubjectAndType(int $subjectId, string $examType): Collection
    {
        return Exam::where('subject_id', $subjectId)
            ->where('exam_type', $examType)
            ->where('start_time', '<', now())
            ->get();
    }

    public function getUpcomingExams(): Collection
    {
        return Exam::with(['teacher', 'subject'])
            ->where('start_time', '>', now())
            ->orderBy('start_time')
            ->get();
    }

    public function getPastExams(): Collection
    {
        return Exam::with(['teacher', 'subject'])
            ->where('start_time', '<', now())
            ->orderBy('start_time', 'desc')
            ->get();
    }

    public function getExamsWithAvailableSlots(): Collection
    {
        return Exam::with(['teacher', 'subject'])
            ->get()
            ->filter(function ($exam) {
                return $exam->remainingSlots() > 0;
            });
    }

    public function createExamRegistration(Student $student, Exam $exam): bool
    {
        try {
            ExamRegistration::create([
                'student_id' => $student->id,
                'exam_id' => $exam->id,
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteExamRegistration(Student $student, Exam $exam): bool
    {
        $registration = ExamRegistration::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->first();

        if ($registration) {
            return $registration->delete();
        }

        return false;
    }

    public function getExamRegistrations(Student $student): Collection
    {
        return $student->registrations()
            ->with(['exam.teacher', 'exam.subject', 'exam.hall'])
            ->get();
    }
}
