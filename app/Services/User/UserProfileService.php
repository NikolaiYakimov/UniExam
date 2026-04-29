<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTOs\UpdatePasswordDto;
use App\DTOs\UpdateProfileDto;
use App\Events\PasswordChanged;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserProfileService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function updateProfile(User $user, UpdateProfileDto $data): void
    {
        $this->userRepository->updateUser($user, [
            'email' => $data->email ?? $user->email,
            'phone' => $data->phone ?? $user->phone,
        ]);
    }

    public function updatePassword(User $user, UpdatePasswordDto $dto): void
    {
        $this->userRepository->updateUser($user, [
            'password' => Hash::make($dto->password),
        ]);

        event(new PasswordChanged($user));
    }
}
