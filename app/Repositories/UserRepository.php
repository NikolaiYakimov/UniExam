<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Administrator;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getAllWithRoles()
    {
        return User::with(['student', 'teacher', 'administrator'])->get();
    }

    public function getUserWithRoleData($id)
    {
        return User::with(['student', 'teacher', 'administrator'])->findOrFail($id);
    }

    public function createUserWithRole($data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data);

            $this->createRoleSpecificData($user, $data);

            return $user;
        });
    }

    public function updateUserWithRole($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = User::findOrFail($id);
            $user->update($data);

            $this->updateRoleSpecificData($user, $data);

            return $user;
        });
    }

    public function deleteUser($id)
    {
        return DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            if ($user->student) {
                $user->student->delete();
            }

            if ($user->teacher) {
                $user->teacher->delete();
            }

            if ($user->administrator) {
                $user->administrator->delete();
            }

            return $user->delete();
        });
    }

    protected function createRoleSpecificData(User $user, $data)
    {
        switch ($data['role']) {
            case 'student':
                Student::create([
                    'user_id' => $user->id,
                    'faculty_number' => $data['faculty_number'] ?? null,
                    'faculty_id' => $data['faculty_id'] ?? null,
                    'specialty_id' => $data['specialty_id'] ?? null,
                    'semester' => $data['semester'] ?? null,
                    'group_id' => $data['group_id'] ?? null,
                ]);
                break;

            case 'teacher':
                Teacher::create([
                    'user_id' => $user->id,
                    'title' => $data['title'] ?? null,
                    'specialty_id' => $data['specialty_id'] ?? null,
                    'faculty_id' => $data['faculty_id'] ?? null,
                ]);
                break;

            case 'administrator':
                Administrator::create([
                    'user_id' => $user->id,
                ]);
                break;
        }
    }

    protected function updateRoleSpecificData(User $user, $data)
    {
//        if ($user->student) {
//            $user->student->delete();
//        }
//
//        if ($user->teacher) {
//            $user->teacher->delete();
//        }
//
//        if ($user->administrator) {
//            $user->administrator->delete();
//        }
//
//
//        $this->createRoleSpecificData($user, $data);
        switch ($data['role']) {
            case 'student':
                if ($user->student) {
                    // АКТУАЛИЗИРАНЕ на съществуващ студент
                    $user->student->update([
                        'faculty_number' => $data['faculty_number'] ?? null,
                        'faculty_id' => $data['faculty_id'] ?? null,
                        'specialty_id' => $data['specialty_id'] ?? null,
                        'semester' => $data['semester'] ?? null,
                        'group_id' => $data['group_id'] ?? null,
                    ]);
                } else {
                    // Създаване на нов запис само ако няма съществуващ
                    Student::create([
                        'user_id' => $user->id,
                        'faculty_number' => $data['faculty_number'] ?? null,
                        'faculty_id' => $data['faculty_id'] ?? null,
                        'specialty_id' => $data['specialty_id'] ?? null,
                        'semester' => $data['semester'] ?? null,
                        'group_id' => $data['group_id'] ?? null,
                    ]);
                }
                break;

            case 'teacher':
                if ($user->teacher) {
                    // АКТУАЛИЗИРАНЕ на съществуващ учител
                    $user->teacher->update([
                        'title' => $data['title'] ?? null,
                        'specialty_id' => $data['specialty_id'] ?? null,
                        'faculty_id' => $data['faculty_id'] ?? null,
                    ]);
                } else {
                    Teacher::create([
                        'user_id' => $user->id,
                        'title' => $data['title'] ?? null,
                        'specialty_id' => $data['specialty_id'] ?? null,
                        'faculty_id' => $data['faculty_id'] ?? null,
                    ]);
                }
                break;

            case 'administrator':
                if (!$user->administrator) {
                    Administrator::create([
                        'user_id' => $user->id,
                    ]);
                }
                break;
        }

        // ИЗТРИВАНЕ на ненужни ролеви данни
        if ($data['role'] !== 'student' && $user->student) {
            $user->student->delete();
        }

        if ($data['role'] !== 'teacher' && $user->teacher) {
            $user->teacher->delete();
        }

        if ($data['role'] !== 'administrator' && $user->administrator) {
            $user->administrator->delete();
        }
    }
}
