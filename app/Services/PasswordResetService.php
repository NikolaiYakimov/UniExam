<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\PasswordChanged;
use App\Events\PasswordResetRequested;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;

class PasswordResetService
{
    public function __construct(
        private readonly PasswordResetRepository $passwordResetRepository,
        private readonly UserRepository $userRepository
    ) {}

    public function sendResetLink(string $email): bool
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return false;
        }

        $token = $this->passwordResetRepository->createResetToken($email);

        event(new PasswordResetRequested($user, $token));

        return true;
    }

    public function resetPassword(string $token, string $email, string $password): string
    {
        $resetRecord = $this->passwordResetRepository->getResetRecord($email);

        if (!$resetRecord || !$this->passwordResetRepository->validateToken($resetRecord, $token)) {
            return 'invalid_token';
        }

        if ($this->passwordResetRepository->isTokenExpired($resetRecord)) {
            return 'expired_token';
        }

        $user = $this->userRepository->findByEmail($email);
        $this->passwordResetRepository->updatePassword($user, $password);
        $this->passwordResetRepository->deleteResetRecord($email);

        event(new PasswordChanged($user));

        return 'success';
    }
}
