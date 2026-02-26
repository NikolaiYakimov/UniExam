<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetRepository
{
    public function createResetToken($email)
    {
        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        return $token;
    }

    public function getResetRecord($email)
    {
        return DB::table('password_resets')
            ->where('email', $email)
            ->first();
    }

    public function validateToken($resetRecord, $token)
    {
        return $resetRecord && Hash::check($token, $resetRecord->token);
    }

    public function isTokenExpired($resetRecord)
    {
        return now()->diffInMinutes($resetRecord->created_at) > 60;
    }

    public function deleteResetRecord($email)
    {
        return DB::table('password_resets')->where('email', $email)->delete();
    }

    public function updatePassword($user,$password){
        $user->password = Hash::make($password);
        $user->save();
    }
}
