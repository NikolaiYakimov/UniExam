<?php

namespace App\Repositories;

use App\Models\Subject;
//use App\Models\Student;

class SubjectRepository
{
    public function getTeacherSubjectsWithStudentsCount($teacherId)
    {
        return Subject::whereHas('teachers', function($query) use ($teacherId) {
            $query->where('teachers.id', $teacherId);
        })->withCount('students')->get();
    }

    public function getSubjectStudents($subjectId)
    {
        return Subject::findOrFail($subjectId)
            ->students()
            ->with('user', 'specialty')
            ->orderBy('faculty_number')
            ->get();
    }

    public function toggleAttestation($subjectId, $studentId, $currentStatus)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject->students()->updateExistingPivot($studentId, [
            'has_attestation' => !$currentStatus
        ]);

        return !$currentStatus;
    }

    public function getAll()
    {
        return Subject::all();
    }

    public function getById($id)
    {
        return Subject::findOrFail($id);
    }

    public function create(array $data)
    {
        return Subject::create($data);
    }

    public function update($id, array $data)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($data);
        return $subject;
    }

    public function delete($id)
    {
        $subject = Subject::findOrFail($id);
        return $subject->delete();
    }
}
