<?php

namespace App\Http\Controllers;
use App\Http\Requests\SpecialityRequest;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class SpecialtyController
{
    protected $specialtyService;

    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    public function getSpecialties()
    {
        try {
            $specialties = $this->specialtyService->getAllSpecialties();
            return response()->json([
                'data' => $specialties,
                'message' => 'Specialties retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving specialties: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(SpecialityRequest $request)
    {
        try {
            $validated = $request->validated();

            $specialty = $this->specialtyService->createSpecialty($validated);

            return response()->json([
                'data' => $specialty,
                'message' => 'Specialty created successfully'
            ], 201);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating specialty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $specialty = $this->specialtyService->getSpecialtyById($id);
            return response()->json([
                'data' => $specialty,
                'message' => 'Specialty retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving specialty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(SpecialityRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $specialty = $this->specialtyService->updateSpecialty($id, $validated);

            return response()->json([
                'data' => $specialty,
                'message' => 'Specialty updated successfully'
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating specialty: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->specialtyService->deleteSpecialty($id);

            return response()->json([
                'message' => 'Specialty deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting specialty: ' . $e->getMessage()
            ], 500);
        }
    }
}
