<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Specialty;
use App\Services\SubjectService;


class AdminSubjectController extends Controller
{
    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function uniSubjects()
    {
        $subjects = $this->subjectService->getAllSubjects();
        $allSubjects=$subjects->values()->all();

        return response()->json([
            'success' => true,
            'data' => $allSubjects
        ]);
    }

    //TODO This need to be in the speciality controller , and need to change the name
    public function create()
    {
        $specialties = Specialty::with(['teachers.user'])->get();

        return response()->json([
            'success' => true,
            'specialties' => $specialties,
        ]);
    }

    public function store(SubjectRequest $request) {
        $data = $request->validated();

        $subject = $this->subjectService->createSubjectWithRelations($data);

        return response()->json([
            'success' => true,
            'message' => 'Дисциплината е създадена успешно.',
            'data' => $subject
        ], 201);
    }

    public function edit($id)
    {
        $subject = $this->subjectService->getSubjectWithTeacherById($id);

        $specialties = Specialty::with('teachers.user')->get();
        $selectedSpecialties = $subject->specialties->pluck('id')->toArray();
        $selectedTeachers = $subject->teachers->pluck('id')->toArray();


        return response()->json([
            'success' => true,
            'data' => $subject,
            'specialties' => $specialties,
            'selectedSpecialties' => $selectedSpecialties,
            'selectedTeachers' => $selectedTeachers
        ]);
    }

    public function update(SubjectRequest $request, $id)
    {
        $data = $request->validated();
        $subject = $this->subjectService->updateSubjectWithRelations($id, $data);

        return response()->json([
            'success' => true,
            'message' => 'Дисциплината е актуализирана успешно.',
            'data' => $subject
        ]);


    }

    public function destroy($id)
    {
        $this->subjectService->deleteSubject($id);

        return response()->json([
            'success' => true,
            'message' => 'Дисциплината е изтрита успешно.'
        ]);
    }
}

