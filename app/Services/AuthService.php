<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function __construct(
        private readonly AuthRepository $authRepository
    ) {}

    public function apiLogin(array $credentials): array
    {
        $user = $this->authRepository->findUserByUsername($credentials['username']);

        if (!$user || !$this->authRepository->verifyPassword($user, $credentials['password'])) {
            throw new \Exception('Грешно потребителско име или парола.', 401);
        }

        $this->authRepository->deleteUserTokens($user);
        $this->authRepository->loadUserRelations($user);

        $token = $this->authRepository->createAuthToken($user);
        $expiration = config('sanctum.expiration');

        return [
            'token' => $token,
            'user' => $user,
            'redirect' => $this->apiRedirectByRole($user->role),
            'expires_in' => $expiration ? $expiration * 60 : null,
        ];
    }

    public function apiLogout(User $user): array
    {
        $success = $this->authRepository->deleteCurrentToken($user);

        if ($success) {
            Log::debug("Напуснах системата");
            return ['message' => 'Успешно излязохте от системата.'];
        }

        throw new \Exception('Logout failed', 500);
    }

    public function getUserWithRelations(User $user): User
    {
        $this->authRepository->loadUserRelations($user);
        return $user;
    }

    private function apiRedirectByRole(string $role): string
    {
        $routes = [
            'administrator' => '/admin/dashboard',
            'teacher' => '/teacher/dashboard',
            'student' => '/student/exams',
        ];

        return $routes[$role] ?? '/login';
    }
}
