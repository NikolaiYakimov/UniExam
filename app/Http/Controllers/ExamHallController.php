<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamHallRequest;
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

    public function store(ExamHallRequest $request){
        try {
            $data = $request->validated();
            $examHall = ExamHall::create($data);

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

    //TODO да погледна това
    public function edit(ExamHall $examHall)
    {
        try {
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

    public function update(ExamHallRequest $request,ExamHall $examHall){
        try {
            $data = $request->validated();
            //TODO Да го преместя в service
            $examHall->update($data);
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
