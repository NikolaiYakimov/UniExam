<?php

namespace App\Services\SchedulerServices;

use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Student;
use Carbon\Carbon;

class AutoRegistrationService
{
    public function autoRegistrationForExam(): int
    {
        $today=Carbon::today();

        $exams=Exam::with(['subject.specialties'])
            ->whereDate('start_time',$today)
            ->get();

        $registeredCount=0;

        foreach ($exams as $exam){
            if($exam->end_time<now()){
                continue;
            }
            if(!$exam->hasAvailableSlots()){
                Log::info("Exam {$exam->id} has no available slots, skipping auto-registration.");
                continue;
            }
            $specialtyIds=$exam->subject->specialties->pluck('id')->toArray();

            $students=Student::whereHas('subjects',function($query) use($exam){
                $query->where('subject_id',$exam->subject_id)->where('has_attestation',true);
            })
                ->whereDoesntHave('registration',function($query) use($exam){
                    $query->where('exam_id',$exam->id);
                })
                ->where('semester','>=',$exam->subject->semester)
                ->whereIn('specialty_id',$specialtyIds)
                ->get();

            foreach ($students as $student){
                if (!$exam->hasAvailableSlots()) {
                    Log::info("No more available slots for exam {$exam->id}, stopping auto-registration.");
                    break;
                }
                try{
                    ExamRegistration::create([
                        'exam_id'=>$exam->id,
                        'student_id'=>$student->id,
                        'is_walk_in'=>true,
                    ]);
                    $registeredCount++;
                    Log::info("Auto-registered student {$student->id} for exam {$exam->id} as walk-in.");
                    $exam->refresh();
                }catch (\Exception $e){
                    Log::error("Failed to auto-register student {$student->id} for exam {$exam->id}: " . $e->getMessage());
                }
            }
        }
        return $registeredCount;

    }
}
