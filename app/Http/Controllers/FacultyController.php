<?php

namespace App\Http\Controllers;

use App\Services\FacultyService;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class FacultyController
{
    protected $facultyService;

    public function __construct(FacultyService $facultyService)
    {
        $this->facultyService = $facultyService;
    }

    public function getFaculties()
    {
        try {
            $faculties = $this->facultyService->getAllFaculties();
            return response()->json([
                'data' => $faculties,
                'message' => 'Faculties retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving faculties: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:faculties'
            ]);

            $faculty = $this->facultyService->createFaculty($validated);

            return response()->json([
                'data' => $faculty,
                'message' => 'Faculty created successfully'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating faculty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $faculty = $this->facultyService->getFacultyById($id);
            return response()->json([
                'data' => $faculty,
                'message' => 'Faculty retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving faculty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:faculties,name,' . $id
            ]);

            $faculty = $this->facultyService->updateFaculty($id, $validated);

            return response()->json([
                'data' => $faculty,
                'message' => 'Faculty updated successfully'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating faculty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->facultyService->deleteFaculty($id);

            return response()->json([
                'message' => 'Faculty deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting faculty: ' . $e->getMessage()
            ], 500);
        }
    }
}
