<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\FacultyRequest;

readonly class FacultyDto
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest(FacultyRequest $request): self
    {
        $data = $request->validated();
        return new self(
            name: $data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
