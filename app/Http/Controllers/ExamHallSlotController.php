<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetBookedSlotsRequest;
use App\Http\Resources\BookedSlotResource;
use App\Services\Exam\ExamScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamHallSlotController extends Controller
{
    public function __construct(
        private readonly ExamScheduleService $scheduleService,
    ){}

    //Return time slots for the given date and hall
    public function index(GetBookedSlotsRequest $request):JsonResponse
    {
        try {
            $data=$request->validated();

            $slots = $this->scheduleService->getBookedSlots($data['hall_id'],
                $data['date'],
                $request->input('exclude_exam_id', null))->filter();

            return response()->json([
            'bookedSlots'=>BookedSlotResource::collection($slots),
                'date'=>$data['date'],
                'hall_id'=>$data['hall_id'],
                'count'=>$slots->count(),
                'timestamp' => now()->toIso8601String()
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage() . " |||| " . $exception->getTraceAsString());
            return response()->json(
                [
                    'success'=>false,
                    'message' => $exception->getMessage()
                ]);
        }
    }
}
