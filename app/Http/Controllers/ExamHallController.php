<?php

namespace App\Http\Controllers;

use App\DTOs\ExamHallDto;
use App\Http\Requests\ExamHallRequest;
use App\Http\Resources\ExamHallListResource;
use App\Models\ExamHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ExamHallController extends Controller
{
    public function __construct(private readonly \App\Services\ExamHallService $examHallService)
    {
    }

    public function getExamHalls()
    {
        try {
            $examHalls = $this->examHallService->getAllExamHalls();
            return response()->json([
                'success' => true,
                'data' => ExamHallListResource::collection($examHalls)
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при зареждане на зали: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при зареждане на зали'
            ], 500);
        }
    }

    public function store(ExamHallRequest $request)
    {
        try {
            $dto = ExamHallDto::fromRequest($request);
            $examHall = $this->examHallService->createExamHall($dto);

            return response()->json([
                'message' => 'Залата е създадена успешно!',
                'data' => $examHall,
                'success' => true
            ], 201);
        } catch (\Exception $e) {
            Log::error('Грешка при създаване на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при създаване на зала'
            ], 500);
        }
    }

    public function edit(ExamHall $examHall)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $examHall
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при зареждане на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при зареждане на зала'
            ], 500);
        }
    }

    public function update(ExamHallRequest $request, ExamHall $examHall)
    {
        try {
            $dto = ExamHallDto::fromRequest($request);
            $this->examHallService->updateExamHall($examHall, $dto);
            return response()->json([
                'message' => 'Изпитната зала беше променена',
                'data' => $examHall,
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при актуализация на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при актуализация на зала'
            ], 500);
        }
    }

    public function destroy(ExamHall $examHall)
    {
        try {
            $this->examHallService->deleteExamHall($examHall);

            return response()->json([
                'success' => true,
                'message' => 'Залата е изтрита успешно!'
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при изтриване на зала: ' . $e->getMessage());

            $isValidationException = $e->getMessage() === 'Не може да изтриете зала, която се използва в изпити!';

            return response()->json([
                'success' => false,
                'message' => $isValidationException ? $e->getMessage() : 'Грешка при изтриване на зала'
            ], $isValidationException ? 422 : 500);
        }
    }

}
