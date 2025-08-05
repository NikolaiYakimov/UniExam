<?php

namespace App\Services;

use App\Models\AcademicSemester;
use App\Models\Student;
use Carbon\Carbon;

class SemesterService
{
public function updateCurrentSemester(): bool
{

    $today=Carbon::today();

    $currentSemester=AcademicSemester::where('is_current',true)->first();
    $nextSemester=AcademicSemester::where('start_date','>',$today)->orderBy('start-date')->first();

    if($nextSemester&&$today->eq(Carbon::parse($nextSemester->start_date))){
        if($currentSemester){
            $currentSemester->is_current=false;
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
