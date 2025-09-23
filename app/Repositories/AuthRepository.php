<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function findUserByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    public function verifyPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    public function deleteUserTokens(User $user): void
    {
        $user->tokens()->delete();
    }

    public function createAuthToken(User $user): string
    {
        return $user->createToken('api-token')->plainTextToken;
    }

    public function deleteCurrentToken(User $user): bool
    {
        try {
            $user->currentAccessToken()->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Token deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    public function loadUserRelations(User $user): void
    {
        switch ($user->role) {
            case 'student':
                $user->load(['student.faculty', 'student.specialty', 'student.group']);
                break;
            case 'teacher':
                $user->load(['teacher.faculty', 'teacher.specialty', 'teacher.exams']);
                break;
            case 'administrator':
                $user->load('administrator');
                break;
        }
    }
}
