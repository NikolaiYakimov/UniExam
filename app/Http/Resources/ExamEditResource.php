<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'hall_id' => $this->hall_id,
            'exam_type' => $this->exam_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'max_students' => $this->max_students,
        ];
    }
}
