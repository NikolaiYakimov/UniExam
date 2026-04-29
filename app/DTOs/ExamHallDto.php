<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\ExamHallRequest;

readonly class ExamHallDto
{
    public function __construct(
        public string $hall_name,
        public int $capacity,
    ) {}

    public static function fromRequest(ExamHallRequest $request): self
    {
        $data = $request->validated();
        return new self(
            hall_name: $data['hall_name'],
            capacity: (int) $data['capacity'],
        );
    }

    public function toArray(): array
    {
        return [
            'hall_name' => $this->hall_name,
            'capacity' => $this->capacity,
        ];
    }
}
