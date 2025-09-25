<?php

namespace App\Services;

use App\Mail\PasswordChangedMail;
use App\Mail\PasswordResetMail;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

class PasswordResetService
{
    protected $passwordResetRepository;
    protected $userRepository;

    public function __construct(
        PasswordResetRepository $passwordResetRepository,
        UserRepository $userRepository
    ) {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userRepository = $userRepository;
    }

    public function sendResetLink($email)
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return ['success' => false, 'message' => 'Потребител с този имейл не съществува'];
        }

        $token = $this->passwordResetRepository->createResetToken($email);

        try {
            Mail::to($email)->queue(new PasswordResetMail($token, $user));
            return ['success' => true, 'message' => 'Изпратихме ви имейл с линк за възстановяване на паролата!'];
        } catch (\Exception $e) {
            Log::error("Failed to send password reset email: " . $e->getMessage());
            return ['success' => false, 'message' => 'Грешка! Възникна грешка при изпращането на имейла!'];
        }
    }

    public function resetPassword($token, $email, $password)
    {
        $resetRecord = $this->passwordResetRepository->getResetRecord($email);

        if (!$resetRecord || !$this->passwordResetRepository->validateToken($resetRecord, $token)) {
            return ['success' => false, 'message' => 'Токенът който беше предоставен е невалиден!'];
        }

        if ($this->passwordResetRepository->isTokenExpired($resetRecord)) {
            return ['success' => false, 'message' => 'Токенът ви е изтекъл. Опитайте отново!'];
        }

        $user = $this->userRepository->findByEmail($email);
        $this->userRepository->updatePassword($user, $password);
        $this->passwordResetRepository->deleteResetRecord($email);

        $this->sendPasswordChangedEmail($user);

        return ['success' => true, 'message' => 'Паролата ви е променена успешно!'];
    }

    protected function sendPasswordChangedEmail($user)
    {
        try {
            if (!empty($user->email)) {
                Mail::to($user->email)->queue(new PasswordChangedMail($user, now()));
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send PasswordChangedMail', [
                "user" => $user,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
