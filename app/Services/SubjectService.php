<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\SubjectDto;
use App\Models\Student;
use App\Models\Subject;
use App\Repositories\SpecialtyRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class SubjectService
{
    public function __construct(
        private readonly SubjectRepository $subjectRepository,
        private readonly SpecialtyRepository $specialtyRepository,
        private readonly StudentRepository $studentRepository
    ) {}

    /**
     * @throws Exception
     */
    public function getTeacherSubjects(int $teacherId): Collection
    {
        $subjects = $this->subjectRepository->getTeacherSubjectsWithStudentsCount($teacherId);
        if ($subjects->isEmpty()) {
            throw new Exception("Нямате назначени предмети за момента");
        }
        return $subjects;
    }

    /**
     * @throws AuthorizationException
     */
    public function getSubjectStudents(int $subjectId, mixed $teacher): Collection
    {
        if (!$teacher->subjects->contains('id', $subjectId)) {
            throw new AuthorizationException('Нямате права за достъп до студентите на този предмет!');
        }

        return $this->subjectRepository->getSubjectStudents($subjectId);
    }

    /**
     * @throws Exception
     */
    public function toggleAttestation(int $subjectId, int $studentId, mixed $teacher): mixed
    {
        if (!$teacher->subjects->contains('id', $subjectId)) {
            throw new Exception('Нямате права да променяте заверката на студента за този предмет.');
        }
        $studentStatus = $this->subjectRepository->getStudentAttestationStatus($studentId, $subjectId);

        return $this->subjectRepository->toggleAttestation($subjectId, $studentId, $studentStatus);
    }

    public function getAllSubjects(): Collection
    {
        return $this->subjectRepository->getAll();
    }

    public function getSubjectById(int $id): Subject
    {
        return $this->subjectRepository->getSubjectById($id);
    }

    public function getSubjectEditData(int $id): array
    {
        $subject = $this->subjectRepository->getSubjectWithTeacher($id);
        $specialties = $this->specialtyRepository->getSpecialtyWithTeachers();

        return [
            'data' => $subject,
            'specialties' => $specialties,
            'selectedSpecialties' => $subject->specialties->pluck('id')->toArray(),
            'selectedTeachers' => $subject->teachers->pluck('id')->toArray(),
        ];
    }

    public function createSubject(SubjectDto $dto): Subject
    {
        return $this->subjectRepository->create($dto->toArray());
    }

    public function updateSubject(int $id, SubjectDto $dto): Subject
    {
        return $this->subjectRepository->update($id, $dto->toArray());
    }

    public function deleteSubject(int $id): bool
    {
        return $this->subjectRepository->delete($id);
    }

    public function createSubjectWithRelations(SubjectDto $dto): Subject
    {
        $subject = $this->subjectRepository->create($dto->toArray());

        if (!empty($dto->specialties)) {
            $subject->specialties()->sync($dto->specialties);

            $students = $this->studentRepository->getStudentsBySemesterAndSpecialties(
                $dto->semester,
                $dto->specialties
            );
            $subject->students()->attach($students, ['has_attestation' => true]);
        }

        if (!empty($dto->teachers)) {
            $subject->teachers()->sync($dto->teachers);
        }

        return $subject;
    }

    public function updateSubjectWithRelations(int $id, SubjectDto $dto): Subject
    {
        $subject = $this->subjectRepository->update($id, $dto->toArray());

        if (!empty($dto->specialties)) {
            $subject->specialties()->sync($dto->specialties);
        } else {
            $subject->specialties()->detach();
        }

        if (!empty($dto->teachers)) {
            $subject->teachers()->sync($dto->teachers);
        } else {
            $subject->teachers()->detach();
        }

        return $subject;
    }
}
