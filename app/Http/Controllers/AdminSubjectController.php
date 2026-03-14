<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use App\Services\SubjectService;
use App\Services\TeacherService;


class AdminSubjectController extends Controller
{

    public function __construct(private readonly SubjectService $subjectService, private readonly SpecialtyService $specialtyService)
    {
    }

    public function uniSubjects()
    {
        $subjects = $this->subjectService->getAllSubjects()->values()->all();

        return response()->json([
            'success' => true,
            'data' => $subjects
        ]);
    }

    //TODO This need to be in the speciality controller , and need to change the name
    public function create()
    {
        $specialties = $this->specialtyService->getAllSpecialties();

        return response()->json([
            'success' => true,
            'specialties' => $specialties,
        ]);
    }

    public function store(SubjectRequest $request)
    {
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
        $data = $this->subjectService->getSubjectEditData($id);

        return response()->json([
            'success' => true,
            'data' => $data
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

