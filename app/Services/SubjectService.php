<?php

namespace App\Services;
use App\Models\Student;
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

        if (!$teacher->subjects->contains('id', $subjectId)) {
            abort(403);
        }

        return $this->subjectRepository->getSubjectStudents($subjectId);
    }

    public function toggleAttestation($subjectId, $studentId, $currentStatus)
    {
        $teacher = Auth::user()->teacher;

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
        return $this->subjectRepository->getSubjectById($id);
    }

    public function getSubjectWithTeacherById($id)
    {
        return $this->subjectRepository->getSubjectWithTeacher($id);
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

    public function createSubjectWithRelations(array $data) {
        $subject = $this->subjectRepository->create($data);

        if (!empty($data['specialties'])) {
            $subject->specialties()->sync($data['specialties']);

            $students = Student::where('semester', $data['semester'])
                ->whereIn('specialty_id', $data['specialties'])
                ->get();
            $subject->students()->attach($students, ['has_attestation' => true]);
        }

        if (!empty($data['teachers'])) {
            $subject->teachers()->sync($data['teachers']);
        }

        return $subject;
    }

    public function updateSubjectWithRelations($id, array $data) {
        $subject = $this->subjectRepository->update($id, $data);

        if (!empty($data['specialties'])) {
            $subject->specialties()->sync($data['specialties']);
        } else {
            $subject->specialties()->detach();
        }

        if (!empty($data['teachers'])) {
            $subject->teachers()->sync($data['teachers']);
        } else {
            $subject->teachers()->detach();
        }

        return $subject;
    }

}
