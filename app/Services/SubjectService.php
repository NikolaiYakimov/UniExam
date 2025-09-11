<?php

namespace App\Services;
use App\Repositories\SubjectRepository;
use Illuminate\Support\Facades\Auth;

class SubjectService
{
protected $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function getTeacherSubjects()
    {
        $teacher = Auth::user()->teacher;
        return $this->subjectRepository->getTeacherSubjectsWithStudentsCount($teacher->id);
    }

    public function getSubjectStudents($subjectId)
    {
        $teacher = Auth::user()->teacher;

        // Check if the teacher lector for this subject
        if (!$teacher->subjects->contains('id', $subjectId)) {
            abort(403);
        }

        return $this->subjectRepository->getSubjectStudents($subjectId);
    }

    public function toggleAttestation($subjectId, $studentId, $currentStatus)
    {
        $teacher = Auth::user()->teacher;

        // Check if the teacher lector for this subject
        if (!$teacher->subjects->contains('id', $subjectId)) {
            abort(403);
        }

        return $this->subjectRepository->toggleAttestation($subjectId, $studentId, $currentStatus);
    }

    public function getAllSubjects()
    {
        return $this->subjectRepository->getAll();
    }

    public function getSubjectById($id)
    {
        return $this->subjectRepository->getById($id);
    }

    public function createSubject(array $data)
    {
        return $this->subjectRepository->create($data);
    }

    public function updateSubject($id, array $data)
    {
        return $this->subjectRepository->update($id, $data);
    }

    public function deleteSubject($id)
    {
        return $this->subjectRepository->delete($id);
    }

}
