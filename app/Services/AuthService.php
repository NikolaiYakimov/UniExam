<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        }

        $this->authRepository->deleteUserTokens($user);
        $this->authRepository->loadUserRelations($user);

        $token = $this->authRepository->createAuthToken($user);

        return [
            'token' => $token,
            'user' => $user,
            'redirect' => $this->apiRedirectByRole($user->role),
            'expires_in'=>config('sanctum.expiration')*60
        ];
    }

    public function apiLogout(Request $request): array
    {
        $success = $this->authRepository->deleteCurrentToken($request->user());

        if ($success) {
            Log::debug("Напуснах системата");
            return ['message' => 'Успешно излязохте от системата.'];
        }

        throw new \Exception('Logout failed', 500);
    }

    public function getUserWithRelations(Request $request)
    {
        $user = $request->user();
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
