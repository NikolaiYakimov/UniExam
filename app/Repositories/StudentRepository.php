<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Collection;

class StudentRepository
{
    public function getStudentsBySemesterAndSpecialties(int $semester, array $specialtyIds): Collection
    {
        return Student::where('semester', $semester)
            ->whereIn('specialty_id', $specialtyIds)
            ->get();
    }

    public function incrementSemesterForAllEligible(int $maxSemester): int
    {
        return Student::where('semester', '<', $maxSemester)->increment('semester');
    }

    public function getStudentById(int $id): Student
    {
        return Student::findOrFail($id);
    }

    public function getAllStudentsWithEmail(): Collection
    {
        return Student::with('user')->whereHas('user', function ($q) {
            $q->whereNotNull('email');
        })->get();
    }
}
