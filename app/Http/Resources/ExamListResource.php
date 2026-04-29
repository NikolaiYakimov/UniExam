<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject_name' => $this->subject ? $this->subject->subject_name : null,
            'exam_type' => $this->exam_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'max_students' => $this->max_students,
            'remaining_slots' => $this->remainingSlots(),
            'hall_name' => $this->hall ? $this->hall->hall_name : null,
        ];
    }
}
