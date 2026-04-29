<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\SubjectRequest;

readonly class SubjectDto
{
    public function __construct(
        public string $subject_name,
        public ?string $description,
        public int $semester,
        public float $price,
        public array $specialties,
        public array $teachers,
    ) {}

    public static function fromRequest(SubjectRequest $request): self
    {
        $data = $request->validated();
        return new self(
            subject_name: $data['subject_name'],
            description: $data['description'] ?? null,
            semester: (int) $data['semester'],
            price: (float) $data['price'],
            specialties: $data['specialties'] ?? [],
            teachers: $data['teachers'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'subject_name' => $this->subject_name,
            'description' => $this->description,
            'semester' => $this->semester,
            'price' => $this->price,
        ];
    }
}
