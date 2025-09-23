<?php

namespace App\Services;

use App\Repositories\SpecialtyRepository;

class SpecialtyService
{
    protected $specialtyRepository;

    public function __construct(SpecialtyRepository $specialtyRepository)
    {
        $this->specialtyRepository = $specialtyRepository;
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
