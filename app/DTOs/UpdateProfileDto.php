<?php

namespace App\DTOs;

use App\Http\Requests\UpdateProfileRequest;

readonly class UpdateProfileDto
{
    public function __construct(public ?string $email, public ?string $phone)
    {
    }

    public static function fromRequest(UpdateProfileRequest $request): self
    {
        $data=$request->validated();
        return new self(
            email: $data['email']??null,
            phone: $data['phone']??null,
        );
    }
    public function toArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'phone' => $this->phone,
        ],fn($value)=>!is_null($value));
    }
}
