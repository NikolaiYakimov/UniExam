<?php

namespace App\Repositories;

use App\Models\Specialty;

class SpecialtyRepository
{
    public function getAllSpecialties()
    {
        return Specialty::with('faculty')->get();
    }

    public function getById($id)
    {
        return Specialty::with('faculty')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Specialty::create($data);
    }

    public function update($id, array $data)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->update($data);
        return $specialty->load('faculty');
    }

    public function delete($id)
    {
        $specialty = Specialty::findOrFail($id);
        return $specialty->delete();
    }

}
