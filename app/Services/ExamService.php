<?php

namespace App\Services;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Whoops\Example\Exception;

class ExamService{
    protected $examRepository;

    public function __construct(ExamRepositoryInterface $examRepository){
        $this->examRepository = $examRepository;

    }

    public function createExam(array $data):Exam{

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
//            'price' => $data['exam_type'] === 'ликвидация' ? $data['price'] : 0
            ]
        );
    }

    public function getBookedSlots(int $hallId,string $date){

        $dateObj=Carbon::parse($date);
        $start=$dateObj->copy()->startOfDay();
        $end=$dateObj->copy()->endOfDay();

        return $this->examRepository->getBookedSlots($hallId,$start,$end);
    }

    function updateExam(Exam $exam,array $data):Exam
    {
        if($exam->subject_id!=$data['subject_id']){
            throw new \Exception("Предмета не може да бъде променян");
        }
        if($exam->exam_type!=$data['exam_type']){
            throw new \Exception('Типът на изпита не може да бъде променян');
        }

        $hall=ExamHall::findOrFail($data['hall_id']);
        $startTime=Carbon::parse($data['start_time']);
        $endTime=Carbon::parse($data['end_time']);

        $now=Carbon::now();
        if($startTime->isPast()||$startTime->diffInDays($now)<48){
            throw new \Exception('Изпитът не може да бъде насрочен в миналото или по-рано от 48 часа от текущия момент. Моля, изберете валидни дата и час.');
        }

        $hasOverlap=Exam::where('hall_id',$hall->id)
            ->where('id','!=',$exam->id)
            ->where(function($query) use ($startTime,$endTime){
                $query->where('end_time', '>', $startTime)
                    ->where('start_time', '<', $endTime);
            })->exists();

        if($hasOverlap){
            throw new \Exception("Залата е заета за ибразия от вас интервал от време.");
        }

        $exam->update([
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
        ]);
        return $exam;

    }


}
