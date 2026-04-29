<?php

namespace App\Http\Controllers;
use App\DTOs\SpecialtyDto;
use App\Http\Requests\SpecialityRequest;
use App\Http\Resources\SpecialtyListResource;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class SpecialtyController
{

    public function __construct(private readonly SpecialtyService $specialtyService)
    {
    }

    public function getSpecialties()
    {
        try {
            $specialties = $this->specialtyService->getAllSpecialties();
            return response()->json([
                'data' => SpecialtyListResource::collection($specialties),
                'message' => 'Заповядайте вашите специалности!'
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при извеждане на спецялностите!'
            ], 500);
        }
    }

    public function store(SpecialityRequest $request)
    {
        try {
            $dto = SpecialtyDto::fromRequest($request);

            $specialty = $this->specialtyService->createSpecialty($dto);

            return response()->json([
                'data' => $specialty,
                'message' => 'Специалноста е създадена успешно!'
            ], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при създаване на специалността!'
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $specialty = $this->specialtyService->getSpecialtyById($id);
            return response()->json([
                'data' => $specialty,
                'message' => 'Заповядайте вашата специалност!'
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при извлизаче на специалността!'
            ], 500);
        }
    }

    public function update(SpecialityRequest $request, $id)
    {
        try {
            $dto = SpecialtyDto::fromRequest($request);

            $specialty = $this->specialtyService->updateSpecialty($id, $dto);

            return response()->json([
                'data' => $specialty,
                'message' => 'Специалността беше променена успешно!'
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при промяната на специалността!'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->specialtyService->deleteSpecialty($id);

            return response()->json([
                'message' => 'Успешно изтрихте специалността!'
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());

            return response()->json([
                'message' => 'Грешка при изтриването на специалнотта!'
            ], 500);
        }
    }
}
