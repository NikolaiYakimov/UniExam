<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\FacultyDto;
use App\Models\Faculty;
use App\Repositories\FacultyRepository;
use Illuminate\Support\Collection;

class FacultyService
{
    public function __construct(
        private readonly FacultyRepository $facultyRepository
    ) {}

    public function getAllFaculties(): Collection
    {
        return $this->facultyRepository->getAllFaculties();
    }

    public function createFaculty(FacultyDto $dto): Faculty
    {
        return $this->facultyRepository->create($dto->toArray());
    }

    public function getFacultyById(int $id): Faculty
    {
        return $this->facultyRepository->getById($id);
    }

    public function updateFaculty(int $id, FacultyDto $dto): Faculty
    {
        return $this->facultyRepository->update($id, $dto->toArray());
    }

    public function deleteFaculty(int $id): bool
    {
        return $this->facultyRepository->delete($id);
    }
}
