<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthService
{

    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function apiLogin(array $credentials): array
    {
        $user = $this->authRepository->findUserByUsername($credentials['username']);

        if (!$user || !$this->authRepository->verifyPassword($user, $credentials['password'])) {
            throw new \Exception('Грешно потребителско име или парола.', 401);
//            throw ValidationException::withMessages([
//                'username'=>["Грешно потребителско име или парола. "]
//            ]);
        }

        $this->authRepository->deleteUserTokens($user);
        $this->authRepository->loadUserRelations($user);

        $token = $this->authRepository->createAuthToken($user);
        $expiration=config('sanctum.expiration');
        return [
            'token' => $token,
            'user' => $user,
            'redirect' => $this->apiRedirectByRole($user->role),
            'expires_in' => $expiration ? $expiration * 60 : null        ];
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
