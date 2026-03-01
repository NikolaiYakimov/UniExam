<?php

namespace App\Services;
use App\Mail\ExamCreatedMail;
use App\Models\Exam;
use App\Models\ExamHall;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\ExamRepository;
use App\Repositories\ExamRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Types\Relations\Car;
use Whoops\Example\Exception;
use Illuminate\Support\Collection;
use function PHPUnit\Framework\isString;


class ExamService{


    public function __construct(private readonly ExamRepositoryInterface $examRepository){
    }

    public function createExam(array $data, Teacher $teacher
    ):Exam{

        $hall=ExamHall::findOrFail($data['hall_id']);
        $startTime=Carbon::parse($data['start_time']);
        $endTime=Carbon::parse($data['end_time']);

//        $hallOpeningTime=Carbon::parse($hall->opening_time)->setDateFrom($startTime);
//        $hallClosingTime=Carbon::parse($hall->closing_time)->setDateFrom($startTime);
//
//        if($data['max_students']>$hall->capacity){
//            throw new \Exception("Грешка! Максималния брой на студентите не може да надвишава капацитета на залата ({$hall->capacity})");
//        }
//
//        if($startTime->lt($hallOpeningTime)){
//            throw new \Exception("Залата отваря в {$hall->opening_time}");
//        }
//        if($endTime->gt($hallClosingTime)){
//            throw new \Exception("Залата затваря в {$hall->closing_time}");
//
//        }
        $this->validateExamTime($hall, $startTime, $endTime, $data['max_students']);
        $hasOverlap=$this->examRepository->hasOverlap($hall->id,$startTime,$endTime);

        if($hasOverlap){
            throw new \Exception("Залата е заета през избрания интервал");
        }

        $exam=$this->examRepository->store([
            'teacher_id' =>$teacher->id,
            'subject_id' => $data['subject_id'],
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
            'exam_type' => $data['exam_type'],
            ]

        );
        $this->notifyAllStudentsForNewExam($exam);
        return $exam;
////        return $this->examRepository->store([
////            'teacher_id' =>$teacher->id,
////            'subject_id' => $data['subject_id'],
////            'hall_id' => $data['hall_id'],
////            'start_time' => $startTime,
////            'end_time' => $endTime,
////            'max_students' => $data['max_students'],
////            'exam_type' => $data['exam_type'],
//
//            ]


//               $exam= $this->examRepository->store([
//                'teacher_id' => Auth::user()->teacher->id,
//                'subject_id' => $data['subject_id'],
//                'hall_id' => $data['hall_id'],
//                'start_time' => $startTime,
//                'end_time' => $endTime,
//                'max_students' => $data['max_students'],
//                'exam_type' => $data['exam_type'],
//            ]
//        );
////        $this->sendExamCreationEmail($exam);
////        return $exam;
    }

    protected function notifyAllStudentsForNewExam(Exam $exam)
    {
        $students = Student::with('user')->whereHas('user', function ($q) {
            $q->whereNotNull('email');
        })->get();

        foreach ($students as $student) {
            Mail::to($student->user->email)->queue(new ExamCreatedMail($exam));
        }

    }

    public function getBookedSlots(int $hallId,string $date,int $excludeExamId=null){

        $dateObj=Carbon::parse($date);
        $start=$dateObj->copy()->startOfDay();
        $end=$dateObj->copy()->endOfDay();
        $bookedSlots=$this->examRepository->getBookedSlots($hallId,$start,$end,$excludeExamId);
        \Illuminate\Log\log($bookedSlots);
//        return $this->examRepository->getBookedSlots($hallId,$start,$end,$excludeExamId);
        return $bookedSlots;
    }

    function updateExam(int $examId,array $data):Exam
    {
        $exam=$this->examRepository->getExamById($examId);
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

        if ($data['max_students'] > $hall->capacity) {
            throw new \Exception("Максималният брой студенти не може да надвишава капацитета на залата ({$hall->capacity}).");
        }
        if($startTime->isPast()||$now->diffInHours($startTime,false)<=48){
            throw new \Exception('Изпитът не може да бъде насрочен в миналото или по-рано от 48 часа от текущия момент. Моля, изберете валидни дата и час.');
        }

        $hasOverlap=$this->examRepository->hasOverlap($hall->id,$startTime,$endTime,$exam->id);


        if($hasOverlap){
            throw new \Exception("Залата е заета за ибразия от вас интервал от време.");
        }
        $updateData = [
            'hall_id' => $data['hall_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'max_students' => $data['max_students'],
        ];

        return $this->examRepository->update($exam, $updateData);

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
//        $regularExamPassed = $this->examRepository
//            ->getExamsBySubjectAndType($subjectId, 'редовен')
//            ->isNotEmpty();
        $studentRegularRegistration = $student->registrations()
            ->whereHas('exam', function($q) use ($subjectId) {
                $q->where('subject_id', $subjectId)
                    ->where('exam_type', 'редовен');
            })
            ->exists();

//        $correctiveExamPassed = $this->examRepository
//            ->getExamsBySubjectAndType($subjectId, 'поправителен')
//            ->isNotEmpty();

        $studentCorrectiveRegistration = $student->registrations()
            ->whereHas('exam', function($q) use ($subjectId) {
                $q->where('subject_id', $subjectId)
                    ->where('exam_type', 'поправителен');
            })
            ->exists();

        switch ($exam->exam_type) {
            case 'редовен':
                return is_null($regularGrade) && $hasAttestation;
            case 'поправителен':
                return ($regularGrade == 2 || (is_null($regularGrade) && $studentRegularRegistration)) && $hasAttestation;
            case 'ликвидация':
                return ($correctiveGrade == 2 ||
                        (is_null($correctiveGrade) && $studentCorrectiveRegistration)) && $hasAttestation;
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

    public function getExamDetails(int $examId,Teacher $teacher): Collection
    {
        $exam = $this->examRepository->getExamDetails($examId);

        if ($exam->teacher_id !== $teacher->id) {
            abort(403);
        }

        return $exam;
    }

//    public function updateGrades($examId, $grades)
//    {
//        $teacher = Auth::user()->teacher;
//        $exam = $this->examRepository->getExamDetails($examId);
//
//        if ($exam->teacher_id !== $teacher->id) {
//            abort(403);
//        }
//
//        $this->examRepository->updateExamGrades($examId, $grades);
//    }

    public function getBookedTimeSlots()
    {
        return $this->examRepository->getBookedTimeSlots();
    }

    public function getTeacherDashboardData(Teacher $teacher): array{
        $exams=$this->examRepository->getTeacherUpcomingExams($teacher->id)->load('subject', 'hall');

        return [
            "exams" => $exams,
            "teacher" => $teacher,
            "subjects" => $teacher->subjects,
            "halls" => ExamHall::all(),
        ];
    }

    private function validateExamTime(ExamHall $examHall,Carbon $startTime,CarBon $endTime,int $maxStudents):void{
        $hallOpeningTime = Carbon::parse($examHall->opening_time)->setDateFrom($startTime);
        $hallClosingTime = Carbon::parse($examHall->closing_time)->setDateFrom($startTime);

        if ($maxStudents > $examHall->capacity) {
            throw new Exception("Грешка! Максималния брой на студентите не може да надвишава капацитета на залата ({$hall->capacity})");
        }
        if ($startTime->lt($hallOpeningTime)) {
            throw new Exception("Залата отваря в {$examHall->opening_time}");
        }
        if ($endTime->gt($hallClosingTime)) {
            throw new Exception("Залата затваря в {$examHall->closing_time}");
        }
    }

    /**
     * @throws AuthorizationException
     */
    public function getExamForEdit(int $examId, int $teacher_id):Exam{

        $exam=$this->examRepository->getExamByIdForEdit($examId);
        if($exam->teacher_id !== $teacher_id){
            throw new AuthorizationException("Нямате право да редактирате този изпит");
        }
        return $exam;
    }

}
