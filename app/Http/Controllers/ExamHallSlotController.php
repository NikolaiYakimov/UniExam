<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetBookedSlotsRequest;
use App\Http\Resources\BookedSlotResource;
use App\Models\ExamHall;
use App\Services\ExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamHallSlotController extends Controller
{
    public function __construct(
        private readonly ExamService $examService,
    ){}

    //Return time slots for the given date and hall
    public function index(GetBookedSlotsRequest $request):JsonResponse
    {
        try {
            $data=$request->validated();

            $slots = $this->examService->getBookedSlots($data->hall_id,
                $data->date,
                $request->input('exclude_exam_id', null))->filter();

//            $formatedSlots=$slots->map(function($exam){
//                return [
//                    'id'=>$exam->id,
//                    'hall_id'=>$exam->hall_id,
//                    'start' => $exam->start_time->toIso8601String(),
//                    'end' => $exam->end_time->toIso8601String()
//                ];
//            })->filter()->values();

            return response()->json([
//                'bookedSlots'=>$formatedSlots,
            'bookedSlots'=>BookedSlotResource::collection($slots),
                'date'=>$data->date,
                'hall_id'=>$data->hall_id,
                'count'=>$slots->count(),
                'timestamp' => now()->toIso8601String()
            ]);
        }catch (\Exception $exception){
            \Log::error($exception->getMessage());
            return response()->json(
                [
                    'success'=>false,
                    'message' => 'Грешка при зареждане на запазените часове']);
        }
    }
}
