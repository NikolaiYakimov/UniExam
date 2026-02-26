<?php

namespace App\Services;

use App\DTOs\UpdateProfileDto;
use App\Mail\PasswordChangedMail;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function getUserWithRoleData($id):User
    {
        return $this->userRepository->getUserWithRoleData($id);
    }

    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);

//        return $this->userRepository->createUserWithRole($data);
        $user=$this->userRepository->createUserWithRole($data);
        $this->handleStudentSubjects($user,$data);
        return $user;
    }

    public function updateUser($id, $data)
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

//        return $this->userRepository->updateUserWithRole($id, $data);
        $user= $this->userRepository->updateUserWithRole($id, $data);
        $this->handleStudentSubjects($user,$data);
        return $user;
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
    public function updateProfile(User $user,UpdateProfileDto $data):void
    {
//        $attrs=Arr::only($data,['email','phone']);
//        $user->fill($attrs)->save();

        $user->email= $data->email?? $user->email;
        $user->phone= $data->phone?? $user->phone;
        $user->save();
    }

    public function updatePassword(User $user,array $data):void
    {
        $user->forceFill([
            'password' => Hash::make($data['password']),
        ])->save();

        if(!empty($user->email)){
            Mail::to($user->email)->queue(new PasswordChangedMail($user,now()));
        }
    }

    private function handleStudentSubjects($user, $data): void
    {
        if ($data['role'] === 'student' && !empty($data['specialty_id']) && !empty($data['semester'])) {
            try {
                $student = $user->student;
                if ($student) {
                    $newSubjects = Subject::where('semester', $data['semester'])
                        ->whereHas('specialties', function ($query) use ($data) {
                            $query->where('specialties.id', $data['specialty_id']);
                        })
                        ->get();

                    if ($newSubjects->count() > 0) {
                        $existingSubjectIds = $student->subjects()
                            ->where('semester', $data['semester'])
                            ->pluck('subjects.id')
                            ->toArray();

                        $subjectsToAttach = $newSubjects->filter(function ($subject) use ($existingSubjectIds) {
                            return !in_array($subject->id, $existingSubjectIds);
                        });

                        if ($subjectsToAttach->count() > 0) {
                            $student->subjects()->attach($subjectsToAttach, ['has_attestation' => true]);
//                             $subjectsToAttach->count();
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error('Грешка при управление на предмети за студент: ' . $e->getMessage(), [
                    'user_id' => $user->id,
                    'semester' => $data['semester'],
                    'specialty_id' => $data['specialty_id']
                ]);
            }
        }
    }

    public  function getFormOptions():array{
        return ['faculties'=>Faculty::all(),'specialties'=>Specialty::all(),'groups'=>Group::all()];
    }
//    public function loadUserWithRelations(User $user):User
//    {
//        $relations= match ($user->role){
//            'student' => ['student.faculty', 'student.specialty', 'student.group'],
//            'teacher' => ['teacher.faculty', 'teacher.specialty'],
//            'administrator' => ['administrator'],
//            default => [],
//        };
//        return $user->load($relations);
//    }
}
