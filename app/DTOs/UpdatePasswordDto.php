<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\UpdatePasswordRequest;

readonly class UpdatePasswordDto
{
    public function __construct(
        public string $password,
    ) {}

    public static function fromRequest(UpdatePasswordRequest $request): self
    {
        $data = $request->validated();
        return new self(
            password: $data['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'password' => $this->password,
        ];
    }
}
