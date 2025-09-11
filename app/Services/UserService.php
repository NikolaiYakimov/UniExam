<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllWithRoles();
    }

    public function getUserWithRoleData($id)
    {
        return $this->userRepository->getUserWithRoleData($id);
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->createUserWithRole($data);
    }

    public function updateUser($id, $data)
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->updateUserWithRole($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
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
