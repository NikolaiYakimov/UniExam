<?php

namespace App\Services\SchedulerServices;

use App\Models\AcademicSemester;
use App\Models\Student;
use Carbon\Carbon;

class SemesterService
{
public function updateCurrentSemester(): bool
{

    $today=Carbon::today();

    $currentSemester=AcademicSemester::where('is_current',true)->first();
    $nextSemester=AcademicSemester::where('start_date','>=',$today)->orderBy('start_date')->first();
    \Log::info('В сървиза съм');


    if ($nextSemester && !$nextSemester->is_current && $today->greaterThanOrEqualTo(Carbon::parse($nextSemester->start_date))) {

        if($currentSemester){
            $currentSemester->is_current=false;
            $currentSemester->start_date=Carbon::parse($currentSemester->start_date)->addYears();
            $currentSemester->end_date = Carbon::parse($currentSemester->end_date)->addYear();
            $currentSemester->save();
        }

        $nextSemester->is_current=true;
        $nextSemester->save();

        Student::where('semester','<',8)->increment('semester');

        return true;
    }
    return false;
}

}
