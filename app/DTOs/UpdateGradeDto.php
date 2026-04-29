<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\UpdateGradeRequest;

readonly class UpdateGradeDto
{
    public function __construct(
        public array $grades,
    ) {}

    public static function fromRequest(UpdateGradeRequest $request): self
    {
        $data = $request->validated();
        return new self(
            grades: $data['grades'] ?? [],
        );
    }

    public function toArray(): array
    {
        return $this->grades;
    }
}
