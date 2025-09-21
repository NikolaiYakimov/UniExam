<?php

namespace App\Http\Controllers;

use App\Models\ExamHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ExamHallController extends Controller
{
    public function getExamHalls(){
        try {
            $examHalls = ExamHall::all();
            return response()->json([
                'success' => true,
                'data' => $examHalls
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при зареждане на зали: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при зареждане на зали'
            ], 500);
        }
    }

    public function store(Request $request){
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:30|unique:exam_halls',
                'capacity' => 'required|integer|min: 20',
                'opening_time' => 'required|date_format:H:i',
                'closing_time' => 'required|date_format:H:i|after:opening_time',
            ]);
            $examHall = ExamHall::create($validated);

            return response()->json([
                'message' => 'Exam hall created successfully',
                'data' => $examHall
            ], 201);
        }catch (\Exception $e){
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
//            $examHall=ExamHall::findOrFail($examId)
            return response()->json([
                'success' => true,
                'data' => $examHall
            ]);
        }catch (\Exception $e){
            Log::error('Грешка при зареждане на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при зареждане на зала'
            ], 500);
        }
    }

    public function update(Request $request,ExamHall $examHall){
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:30', Rule::unique('exam_halls')->ignore($examHall->id)],
                'capacity' => 'required|integer|min: 20',
                'opening_time' => 'required|date_format:H:i',
                'closing_time' => 'required|date_format:H:i|after:opening_time',
            ]);

            $examHall->update($validated);
            return response()->json([
                'message' => 'Изпитната зала беше променена',
                'data' => $examHall
            ]);
        }catch (\Exception $e){
            Log::error('Грешка при актуализация на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при актуализация на зала'
            ], 500);
        }
    }

    public function destroy(ExamHall $examHall){
        try {
            if ($examHall->exams()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Не може да изтриете зала, която се използва в изпити!'
                ], 422);
            }

            $examHall->delete();

            return response()->json([
                'success' => true,
                'message' => 'Залата е изтрита успешно!'
            ]);
        } catch (\Exception $e) {
            Log::error('Грешка при изтриване на зала: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Грешка при изтриване на зала'
            ], 500);
        }
    }

}
