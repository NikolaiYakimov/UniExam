<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTOs\CreateUserDto;
use App\DTOs\UpdateUserDto;
use App\Models\User;
use App\Repositories\FacultyRepository;
use App\Repositories\GroupRepository;
use App\Repositories\SpecialtyRepository;
use App\Repositories\UserRepository;
use App\Services\Student\StudentSubjectEnrollmentService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class AdminUserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly FacultyRepository $facultyRepository,
        private readonly SpecialtyRepository $specialtyRepository,
        private readonly GroupRepository $groupRepository,
        private readonly StudentSubjectEnrollmentService $enrollmentService
    ) {}

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAllWithRoles();
    }

    public function getUserWithRoleData(int $id): User
    {
        return $this->userRepository->getUserWithRoleData($id);
    }

    public function createUser(CreateUserDto $dto): User
    {
        $data = $dto->toArray();
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->createUserWithRole($data);
        $this->enrollmentService->enrollStudentInSemesterSubjects($user, $data);

        return $user;
    }

    public function updateUser(int $id, UpdateUserDto $dto): User
    {
        $data = $dto->toArray();
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->userRepository->updateUserWithRole($id, $data);
        $this->enrollmentService->enrollStudentInSemesterSubjects($user, $data);

        return $user;
    }

    public function deleteUser(int $id): bool
    {
        return $this->userRepository->deleteUser($id);
    }

    public function getFormOptions(): array
    {
        return [
            'faculties' => $this->facultyRepository->getAllFaculties(),
            'specialties' => $this->specialtyRepository->getAllSpecialties(),
            'groups' => $this->groupRepository->getAll(),
        ];
    }
}
