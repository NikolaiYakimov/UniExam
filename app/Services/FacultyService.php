<?php

namespace App\Services;

use App\Repositories\FacultyRepository;

class FacultyService
{
    protected $facultyRepository;

    public function __construct(FacultyRepository $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    public function getAllFaculties()
    {
        return $this->facultyRepository->getAllFaculties();
    }

    public function createFaculty(array $data)
    {
        return $this->facultyRepository->create($data);
    }

    public function getFacultyById($id)
    {
        return $this->facultyRepository->getById($id);
    }

    public function updateFaculty($id, array $data)
    {
        return $this->facultyRepository->update($id, $data);
    }

    public function deleteFaculty($id)
    {
        return $this->facultyRepository->delete($id);
    }
}
