<?php

namespace App\Services;
use App\Models\ExamHall;
use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExamService{
    protected $examRepository;

    public function __construct(ExamRepositoryInterface $examRepository){
        $this->examRepository = $examRepository;

    }

    public function createExam(array $data){

        $hall=ExamHall::findOrFail($data['hall_id']);

        $startTime=Carbon::parse($data['start_time']);
        $endTime=Carbon::parse($data['end_time']);

        $hallOpeningTime=Carbon::parse($hall->opening_time)->setDateFrom($startTime);
        $hallClosingTime=Carbon::parse($hall->closing_time)->setDateFrom($startTime);

        if($startTime->lt($hallOpeningTime)){
            throw new \Exception("Залата отваря в {$hall->opening_time}");
        }
        //TODO:I can create Custom Exception instead using \Exception
        if($endTime->gt($hallClosingTime)){
            throw new \Exception("Залата затваря в {$hall->closing_time}");

        }

        $hasOverlap=$this->examRepository->hasOverlap($hall->id,$startTime,$endTime);

        if($hasOverlap){
            throw new \Exception("Залата е заета през избрания интервал");
        }

        return $this->examRepository->store([
            'teacher_id' => Auth::user()->teacher->id,
            'subject_id' => $data['subject_id'],
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
            'exam_type' => $data['exam_type'],
            'price' => $data['exam_type'] === 'ликвидация' ? $data['price'] : 0]);
    }

    public function getBookedSlots(int $hallId,string $date){

        $dateObj=Carbon::parse($date);
        $start=$dateObj->copy()->startOfDay();
        $end=$dateObj->copy()->endOfDay();

        return $this->examRepository->getBookedSlots($hallId,$start,$end);
    }


}
