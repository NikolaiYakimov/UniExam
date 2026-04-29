<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\StoreExamRequest;
use Carbon\Carbon;

readonly class CreateExamDto
{
    public function __construct(
        public int $subject_id,
        public int $hall_id,
        public int $max_students,
        public string $exam_type,
        public Carbon $start_time,
        public Carbon $end_time,
    ) {}

    public static function fromRequest(StoreExamRequest $request): self
    {
        $data = $request->validated();
        return new self(
            subject_id: (int) $data['subject_id'],
            hall_id: (int) $data['hall_id'],
            max_students: (int) $data['max_students'],
            exam_type: $data['exam_type'],
            start_time: Carbon::parse($data['start_time']),
            end_time: Carbon::parse($data['end_time']),
        );
    }

    public function toArray(): array
    {
        return [
            'subject_id' => $this->subject_id,
            'hall_id' => $this->hall_id,
            'max_students' => $this->max_students,
            'exam_type' => $this->exam_type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}
