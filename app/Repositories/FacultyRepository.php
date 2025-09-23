<?php

namespace App\Repositories;

use App\Models\Faculty;

class FacultyRepository
{
    public function getAllFaculties()
    {
        return Faculty::withCount(['specialties', 'students'])->get();
    }

    public function getById($id)
    {
        return Faculty::findOrFail($id);
    }

    public function create(array $data)
    {
        return Faculty::create($data);
    }

    public function update($id, array $data)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->update($data);
        return $faculty;
    }

    public function delete($id)
    {
        $faculty = Faculty::findOrFail($id);
        return $faculty->delete();
    }
}
