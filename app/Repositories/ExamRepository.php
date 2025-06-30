<?php

namespace App\Repositories;

use App\Models\Exam;

class ExamRepository implements ExamRepositoryInterface
{
    /*
     * Search in the database for overlapping exams
     */
    public function hasOverlap($hallId, $startTime, $endTime)
    {
        return Exam::where('hall_id',$hallId)->
            where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)->
                    where('end_time', '>', $startTime);
        })->exists();

    }

    /*
  * Store the exam to the database
  */
    public function store($data):Exam
    {
       return Exam::create($data);

    }

    /*
     * Get the exam slots that are booked for given hall
     */
    public function getBookedSlots($hallId, $startTime, $endTime)
    {
        return Exam::where('hall_id',$hallId)->
            where(function ($query) use ($startTime, $endTime) {
                $query->where('end_time', '>', $startTime)
                    ->where('start_time', '<', $endTime);
        })->select('id', 'hall_id', 'start_time', 'end_time')
            ->get();
    }
}
