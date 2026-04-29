<?php

namespace App\Http\Controllers;

use App\DTOs\FacultyDto;
use App\Http\Requests\FacultyRequest;
use App\Http\Resources\FacultyListResource;
use App\Services\FacultyService;
use Illuminate\Support\Facades\Log;
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
                'data' => FacultyListResource::collection($faculties),
                'message' => 'Faculties retrieved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving faculties: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(FacultyRequest $request)
    {
        try {
            $dto = FacultyDto::fromRequest($request);

            $faculty = $this->facultyService->createFaculty($dto);

            return response()->json([
                'data' => $faculty,
                'message' => 'Faculty created successfully'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при създаване на факултета: '
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

    public function update(FacultyRequest $request, $id)
    {
        try {
            $dto = FacultyDto::fromRequest($request);
            $faculty = $this->facultyService->updateFaculty($id, $dto);

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
