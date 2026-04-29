<?php

namespace App\Repositories;

use App\Models\Subject;
//use App\Models\Student;

class SubjectRepository
{

    public function getSubjectWithAllRelations($id) {
        return Subject::with(['teachers', 'specialties', 'students'])->findOrFail($id);
    }

    public function getSubjectsBySemesterAndSpecialties($semester, array $specialtyIds) {
        return Subject::whereHas('specialties', function($query) use ($specialtyIds) {
            $query->whereIn('specialties.id', $specialtyIds);
        })->where('semester', $semester)->get();
    }

    public function syncSpecialties($subjectId, array $specialtyIds) {
        $subject = Subject::findOrFail($subjectId);
        return $subject->specialties()->sync($specialtyIds);
    }

    public function syncTeachers($subjectId, array $teacherIds) {
        $subject = Subject::findOrFail($subjectId);
        return $subject->teachers()->sync($teacherIds);
    }

    public function getTeacherSubjectsWithStudentsCount(int     $teacherId)
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
    public function getStudentAttestationStatus(int $studentId,int $subjectId)
    {
        return Subject::findOrFail($subjectId)->students()
            ->where('student_id',$studentId)
            ->first()
            ->pivot
            ->has_attestation;
    }

    public function getAll()
    {
        return Subject::all();
    }

    public function getSubjectById($id)
    {
        return Subject::findOrFail($id);
    }
    public function getSubjectWithTeacher($id)
    {
        return Subject::with('teachers')->findOrFail($id);

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

    public function

    delete($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->teachers()->detach();
        $subject->specialties()->detach();
        $subject->students()->detach();

        return $subject->delete();
    }

    public function getStudentSubjectIdsForSemester(int $studentId, int $semester): array
    {
        return \App\Models\Student::findOrFail($studentId)
            ->subjects()
            ->where('semester', $semester)
            ->pluck('subjects.id')
            ->toArray();
    }

    public function getSubjectsBySemesterAndSpecialty(int $semester, int $specialtyId): \Illuminate\Support\Collection
    {
        return Subject::where('semester', $semester)
            ->whereHas('specialties', function ($query) use ($specialtyId) {
                $query->where('specialties.id', $specialtyId);
            })
            ->get();
    }

}
