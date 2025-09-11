<?php

namespace App\Services;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Whoops\Example\Exception;
use Illuminate\Support\Collection;


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

    public function getBookedSlots(int $hallId,string $date,int $excludeExamId=null){

        $dateObj=Carbon::parse($date);
        $start=$dateObj->copy()->startOfDay();
        $end=$dateObj->copy()->endOfDay();

        return $this->examRepository->getBookedSlots($hallId,$start,$end,$excludeExamId);
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
        if($startTime->isPast()||$now->diffInHours($startTime,false)<=48){
            throw new \Exception('Изпитът не може да бъде насрочен в миналото или по-рано от 48 часа от текущия момент. Моля, изберете валидни дата и час.');
        }

        $hasOverlap=$this->examRepository->hasOverlap($hall->id,$startTime,$endTime);


        if($hasOverlap){
            throw new \Exception("Залата е заета за ибразия от вас интервал от време.");
        }
        $updateData = [
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
        ];
//        $exam->update([
//            'hall_id' => $data['hall_id'],
//            'start_time' => $startTime,
//            'end_time' => $endTime,
//            'max_students' => $data['max_students'],
//        ]);
        return $this->examRepository->update($exam, $updateData);
//        return $exam;

    }
    public function getAvailableExams(Student $student): Collection
    {
        $exams = $this->examRepository->getExamsForStudent($student);
        $subjectGrades = $this->getStudentSubjectGrades($student);

        return $exams->filter(function ($exam) use ($subjectGrades, $student) {
            return $this->isExamAvailable($exam, $subjectGrades, $student);
        });
    }

    protected function getStudentSubjectGrades(Student $student): Collection
    {
        return $student->registrations()
            ->with('exam')
            ->whereNotNull('grade')
            ->get()
            ->groupBy('exam.subject_id');
    }

    protected function isExamAvailable(Exam $exam, Collection $subjectGrades, Student $student): bool
    {
        if ($exam->remainingSlots() <= 0) {
            return false;
        }

        $subjectId = $exam->subject_id;
        $isCurrentSemester = $exam->subject->semester == $student->semester;
        $isPastSemester = $exam->subject->semester < $student->semester;

        $grades = $subjectGrades[$subjectId] ?? collect();

        // Проверка дали имаме оценка над 2 (3,...,6)
        if ($grades->contains('grade', '>=', 3)) {
            return false;
        }

        $hasAttestation = $student->hasAttestationForSubject($subjectId);

        if ($isCurrentSemester) {
            return $this->checkCurrentSemesterExam($exam, $student, $grades, $hasAttestation);
        }

        if ($isPastSemester) {
            return $this->checkPastSemesterExam($exam, $student, $grades, $hasAttestation);
        }

        return false;
    }

    protected function checkCurrentSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
    {

        $subjectId = $exam->subject_id;
        $regularGrade = $grades->firstWhere('exam.exam_type', 'редовен')?->grade;
        $correctiveGrade = $grades->firstWhere('exam.exam_type', 'поправителен')?->grade;

        // Използваме repository за получаване на изпити по предмет и тип
        $regularExamPassed = $this->examRepository
            ->getExamsBySubjectAndType($subjectId, 'редовен')
            ->isNotEmpty();

        $correctiveExamPassed = $this->examRepository
            ->getExamsBySubjectAndType($subjectId, 'поправителен')
            ->isNotEmpty();

        switch ($exam->exam_type) {
            case 'редовен':
                return is_null($regularGrade) && $hasAttestation;
            case 'поправителен':
                return ($regularGrade == 2 || (is_null($regularGrade) && $regularExamPassed)) && $hasAttestation;
            case 'ликвидация':
                return ($correctiveGrade == 2 ||
                        (is_null($correctiveGrade) && $correctiveExamPassed)) && $hasAttestation;
            default:
                return $hasAttestation;
        }
    }


    protected function checkPastSemesterExam(Exam $exam, Student $student, Collection $grades, bool $hasAttestation): bool
    {
        $subjectId = $exam->subject_id;

        if (isset($grades[$subjectId])) {
            $hasPassingGrade = $grades[$subjectId]->contains('grade', '>=', 3);
            if ($hasPassingGrade || !$hasAttestation) {
                return false;
            }
        }

        return in_array($exam->exam_type, ['поправителен', 'ликвидация']);
    }

    public function getUpcomingExams(Teacher $teacher): Collection
    {
//        $teacher = Auth::user()->teacher;
        return $this->examRepository->getTeacherUpcomingExams($teacher->id);
    }

    public function getConductedExams()
    {
        $teacher = Auth::user()->teacher;
        return $this->examRepository->getConductedExams($teacher->id);
    }

    public function getExamDetails($examId)
    {
        $teacher = Auth::user()->teacher;
        $exam = $this->examRepository->getExamDetails($examId);

        if ($exam->teacher_id !== $teacher->id) {
            abort(403);
        }

        return $exam;
    }

    public function updateGrades($examId, $grades)
    {
        $teacher = Auth::user()->teacher;
        $exam = $this->examRepository->getExamDetails($examId);

        if ($exam->teacher_id !== $teacher->id) {
            abort(403);
        }

        $this->examRepository->updateExamGrades($examId, $grades);
    }

    public function getBookedTimeSlots()
    {
        return $this->examRepository->getBookedTimeSlots();
    }


}
