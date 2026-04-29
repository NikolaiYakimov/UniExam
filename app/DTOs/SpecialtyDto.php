<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\SpecialityRequest;

readonly class SpecialtyDto
{
    public function __construct(
        public string $name,
        public int $faculty_id,
    ) {}

    public static function fromRequest(SpecialityRequest $request): self
    {
        $data = $request->validated();
        return new self(
            name: $data['name'],
            faculty_id: (int) $data['faculty_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'faculty_id' => $this->faculty_id,
        ];
    }
}
