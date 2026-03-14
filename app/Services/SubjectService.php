<?php

namespace App\Services;
use App\Models\Student;
use App\Repositories\SpecialtyRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
//use phpDocumentor\Reflection\Exception;

class SubjectService
{

    public function __construct(private readonly SubjectRepository $subjectRepository,
    private readonly SpecialtyRepository $specialtyRepository)
    {
    }

    public function getTeacherSubjects(int $teacherId)
    {
        $subjects=$this->subjectRepository->getTeacherSubjectsWithStudentsCount($teacherId);
        if($subjects->isEmpty()){
            throw new Exception("Нямате назначени предмети за момента");
        }
        return $subjects;
    }

    public function getSubjectStudents($subjectId,$teacher)
    {

        if (!$teacher->subjects->contains('id', $subjectId)) {
            throw new AuthorizationException('Нямате права за достъп до студентите на този предмет!');
        }

        return $this->subjectRepository->getSubjectStudents($subjectId);
    }

    public function toggleAttestation($subjectId, $studentId,$teacher)
    {
        if (!$teacher->subjects->contains('id', $subjectId)) {
            throw new \Exception('Нямате права да променяте заверката на студента за този предмет.');
        }
        $studentStatus=$this->subjectRepository->getStudentAttestationStatus($studentId,$subjectId);


        return $this->subjectRepository->toggleAttestation($subjectId, $studentId, $studentStatus);
    }

    public function getAllSubjects()
    {
        return $this->subjectRepository->getAll();
    }

    public function getSubjectById($id)
    {
        return $this->subjectRepository->getSubjectById($id);
    }

    public function getSubjectEditData($id)
    {
        $subject= $this->subjectRepository->getSubjectWithTeacher($id);
        $specialties=$this->specialtyRepository->getSpecialtyWithTeachers();

        return [
            'data' => $subject,
            'specialties' => $specialties,
            'selectedSpecialties' => $subject->specialties->pluck('id')->toArray(),
            'selectedTeachers' => $subject->teachers->pluck('id')->toArray()
        ];
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
