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

//        return view('subjects', compact('subjects'));
        return response()->json([
            'success' => true,
            'data' => $allSubjects
        ]);
    }

    public function create()
    {
        $specialties = Specialty::with(['teachers.user'])->get();

//        return view('admin.subjects.create');
//        return view('create_subject',compact('specialties'));
        return response()->json([
            'success' => true,
            'specialties' => $specialties,
        ]);
    }

//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'subject_name' => 'required|string|max:255',
//            'description' => 'nullable|string',
//            'semester' => 'required|integer|min:1|max:8',
//            'price' => 'required|numeric|min:0',
//            'specialties' => 'nullable|array',
//            'specialties.*' => 'exists:specialties,id',
//            'teachers' => 'nullable|array', // Добавяме валидация за преподаватели
//            'teachers.*' => 'exists:teachers,id'
//
//        ]);
//
//        $subject = $this->subjectService->createSubject($data);
//
//        if (!empty($data['specialties'])) {
//            $subject->specialties()->sync($data['specialties']);
//        }
//
//        $students = Student::where('semester', $data['semester'])
//            ->whereIn('specialty_id', $data['specialties'])
//            ->get();
//        $subject->students()->attach($students, ['has_attestation' => true]);
//
//        // Свързваме преподавателите с предмета
//        if (!empty($data['teachers'])) {
//            $subject->teachers()->sync($data['teachers']);
//        }
//
////        return redirect()->route('admin.subjects.uni_subjects')
////            ->with('success', 'Дисциплината е създадена успешно.');
//        return response()->json([
//            'success' => true,
//            'message' => 'Дисциплината е създадена успешно.',
//            'data' => $subject
//        ], 201);
//    }
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

        $specialties = Specialty::with('teachers.user')->get(); // Зареждаме специалности с преподаватели
//        $selectedSpecialties = $subject->specialties->pluck('id')->toArray();
        $selectedSpecialties = $subject->specialties->pluck('id')->toArray();
        $selectedTeachers = $subject->teachers->pluck('id')->toArray();



//        return response()->json([
//            'success' => true,
//            'data' => $subject,
//            'specialties' => $specialties,
//                'selectedSpecialties' => $selectedSpecialties
//        ]);
        return response()->json([
            'success' => true,
            'data' => $subject,
            'specialties' => $specialties,
            'selectedSpecialties' => $selectedSpecialties,
            'selectedTeachers' => $selectedTeachers // Добавяме избраните преподаватели
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

//        $this->subjectService->updateSubject($id, $data);
        $subject = $this->subjectService->updateSubjectWithRelations($id, $data);

//        if (!empty($data['specialties'])) {
//            $subject->specialties()->sync($data['specialties']);
//        } else {
//            $subject->specialties()->detach();
//        }
//
//        if (!empty($data['teachers'])) {
//            $subject->teachers()->sync($data['teachers']);
//        } else {
//            $subject->teachers()->detach();
//        }

        return response()->json([
            'success' => true,
            'message' => 'Дисциплината е актуализирана успешно.',
            'data' => $subject
        ]);
//        return redirect()->route('admin.subjects.uni_subjects')
//            ->with('success', 'Дисциплината е актуализирана успешно.');

    }

    public function destroy($id)
    {
    /*    $subject = $this->subjectService->getSubjectById($id);
        $subject->teachers()->detach();
        $subject->specialties()->detach();*/
        $this->subjectService->deleteSubject($id);


//        return redirect()->route('admin.subjects.uni_subjects')
//            ->with('success', 'Дисциплината е изтрита успешно.');
        return response()->json([
            'success' => true,
            'message' => 'Дисциплината е изтрита успешно.'
        ]);
    }
}

