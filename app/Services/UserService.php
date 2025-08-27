<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function updateProfile(User $user,array $data):void
    {
        $attrs=Arr::only($data,['email','phone']);
        $user->fill($attrs)->save();
    }

    public function updatePassword(User $user,array $data):void
    {
        $user->forceFill([
            'password' => Hash::make($data['new_password']),
//            'remember_token'=>Str::random(60),
        ])->save();
    }
}
