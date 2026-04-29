<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Http\Requests\UserRequest;

readonly class UpdateUserDto
{
    public function __construct(
        public string $first_name,
        public ?string $second_name,
        public string $last_name,
        public string $username,
        public string $email,
        public ?string $password,
        public ?string $phone,
        public string $role,
        public ?string $faculty_number,
        public ?int $faculty_id,
        public ?int $specialty_id,
        public ?int $semester,
        public ?int $group_id,
        public ?string $title,
    ) {}

    public static function fromRequest(UserRequest $request): self
    {
        $data = $request->validated();
        return new self(
            first_name: $data['first_name'],
            second_name: $data['second_name'] ?? null,
            last_name: $data['last_name'],
            username: $data['username'],
            email: $data['email'],
            password: $data['password'] ?? null,
            phone: $data['phone'] ?? null,
            role: $data['role'],
            faculty_number: $data['faculty_number'] ?? null,
            faculty_id: isset($data['faculty_id']) ? (int) $data['faculty_id'] : null,
            specialty_id: isset($data['specialty_id']) ? (int) $data['specialty_id'] : null,
            semester: isset($data['semester']) ? (int) $data['semester'] : null,
            group_id: isset($data['group_id']) ? (int) $data['group_id'] : null,
            title: $data['title'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'role' => $this->role,
            'faculty_number' => $this->faculty_number,
            'faculty_id' => $this->faculty_id,
            'specialty_id' => $this->specialty_id,
            'semester' => $this->semester,
            'group_id' => $this->group_id,
            'title' => $this->title,
        ], fn($value) => !is_null($value));
    }
}
