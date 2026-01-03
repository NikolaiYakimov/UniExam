<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Student;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function create()
    {
        $specialties = Specialty::with(['teachers.user'])->get();

        return response()->json([
            'success' => true,
            'specialties' => $specialties,
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'semester' => 'required|integer|min:1|max:8',
            'price' => 'required|numeric|min:0',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id',
            'teachers' => 'nullable|array',
            'teachers.*' => 'exists:teachers,id'
        ]);

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

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'semester' => 'required|integer|min:1|max:8',
            'price' => 'required|numeric|min:0',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id',
            'teachers' => 'nullable|array',
        'teachers.*' => 'exists:teachers,id'
        ]);

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

