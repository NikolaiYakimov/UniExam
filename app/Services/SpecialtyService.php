<?php

namespace App\Services;

use App\Repositories\SpecialtyRepository;

class SpecialtyService
{

    public function __construct(private readonly SpecialtyRepository $specialtyRepository)
    {
    }

    public function getSpecialtyWithTeachers()
    {
        return $this->specialtyRepository->getSpecialtyWithTeachers();
    }
    public function getAllSpecialties()
    {
        return $this->specialtyRepository->getAllSpecialties();
    }

    public function createSpecialty(array $data)
    {
        return $this->specialtyRepository->create($data);
    }

    public function getSpecialtyById($id)
    {
        return $this->specialtyRepository->getById($id);
    }

    public function updateSpecialty($id, array $data)
    {
        return $this->specialtyRepository->update($id, $data);
    }

    public function deleteSpecialty($id)
    {
        return $this->specialtyRepository->delete($id);
    }
}
