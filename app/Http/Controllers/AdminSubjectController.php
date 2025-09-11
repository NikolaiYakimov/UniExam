<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Services\SubjectService;
use Illuminate\Http\Request;

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
        return view('subjects', compact('subjects'));
//        return response()->json([
//            'success' => true,
//            'data' => $subjects
//        ]);
    }

    public function create()
    {
        $specialties = Specialty::all();

//        return view('admin.subjects.create');
        return view('create_subject',compact('specialties'));
//        return response()->json([
//            'success' => true,
//            'specialties' => $specialties
//        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'semester' => 'required|integer|min:1|max:8',
            'price' => 'required|numeric|min:0',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id'

        ]);

        $subject = $this->subjectService->createSubject($data);

        if (!empty($data['specialties'])) {
            $subject->specialties()->sync($data['specialties']);
        }

        return redirect()->route('admin.subjects.uni_subjects')
            ->with('success', 'Дисциплината е създадена успешно.');
//        return response()->json([
//            'success' => true,
//            'message' => 'Дисциплината е създадена успешно.',
//            'data' => $subject
//        ], 201);
    }

    public function edit($id)
    {
        $subject = $this->subjectService->getSubjectById($id);

        $specialties = Specialty::all();
        $selectedSpecialties = $subject->specialties->pluck('id')->toArray();

        return view('edit_subject', compact('subject', 'specialties', 'selectedSpecialties'));


//        return response()->json([
//            'success' => true,
//            'data' => $subject,
//            'specialties' => $specialties,
//                'selectedSpecialties' => $selectedSpecialties
//        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'semester' => 'required|integer|min:1|max:8',
            'price' => 'required|numeric|min:0',
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id'
        ]);

//        $this->subjectService->updateSubject($id, $data);
        $subject = $this->subjectService->updateSubject($id, $data);

        if (!empty($data['specialties'])) {
            $subject->specialties()->sync($data['specialties']);
        } else {
            $subject->specialties()->detach();
        }
//        return response()->json([
//            'success' => true,
//            'message' => 'Дисциплината е актуализирана успешно.',
//            'data' => $subject
//        ]);
        return redirect()->route('admin.subjects.uni_subjects')
            ->with('success', 'Дисциплината е актуализирана успешно.');

    }

    public function destroy($id)
    {
        $this->subjectService->deleteSubject($id);

        return redirect()->route('admin.subjects.uni_subjects')
            ->with('success', 'Дисциплината е изтрита успешно.');
//        return response()->json([
//            'success' => true,
//            'message' => 'Дисциплината е изтрита успешно.'
//        ]);
    }
}

