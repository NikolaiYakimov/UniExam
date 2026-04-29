<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\SpecialtyDto;
use App\Models\Specialty;
use App\Repositories\SpecialtyRepository;
use Illuminate\Support\Collection;

class SpecialtyService
{
    public function __construct(
        private readonly SpecialtyRepository $specialtyRepository
    ) {}

    public function getSpecialtyWithTeachers(): Collection
    {
        return $this->specialtyRepository->getSpecialtyWithTeachers();
    }

    public function getAllSpecialties(): Collection
    {
        return $this->specialtyRepository->getAllSpecialties();
    }

    public function createSpecialty(SpecialtyDto $dto): Specialty
    {
        return $this->specialtyRepository->create($dto->toArray());
    }

    public function getSpecialtyById(int $id): Specialty
    {
        return $this->specialtyRepository->getById($id);
    }

    public function updateSpecialty(int $id, SpecialtyDto $dto): Specialty
    {
        return $this->specialtyRepository->update($id, $dto->toArray());
    }

    public function deleteSpecialty(int $id): bool
    {
        return $this->specialtyRepository->delete($id);
    }
}
