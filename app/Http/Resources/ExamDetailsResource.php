<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamDetailsResource extends JsonResource
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
            'hall_name' => $this->hall ? $this->hall->hall_name : null,
            'registrations' => $this->whenLoaded('registrations', function () {
                return $this->registrations->map(function ($registration) {
                    return [
                        'id' => $registration->id,
                        'student_id' => $registration->student_id,
                        'first_name' => $registration->student->user->first_name ?? '',
                        'last_name' => $registration->student->user->last_name ?? '',
                        'faculty_number' => $registration->student->faculty_number ?? '',
                        'grade' => $registration->grade,
                    ];
                });
            }),
        ];
    }
}
