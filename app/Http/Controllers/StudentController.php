<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\SuccessfullyRegistrated;
use App\Models\Exam;
use App\Models\ExamRegistration;
use App\Models\Payment;
use App\Models\Student;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Double;

use Stripe\Stripe;

class StudentController extends Controller
{
//    public function showPaymentForm(Exam $exam)
//    {
//        return view('payment_form',compact('exam'));
//    }
    //Get the exams which the student didn't register
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    private function canRegisterForExam(Exam $exam,Collection $subjectGrades, Student $student)
    {
        $subjectId=$exam->subject_id;
        $grades=$subjectGrades[$subjectId] ?? collect();
        $isCurrentSemester=$exam->subject->semester== $student->semester;
        $isPastSemester=$exam->subject->semester<$student->semester;

        if($grades->contains('grade','>=',3))
        {
            return false;
        }

        $hasFailedRegularExam=$grades->contains(fn($reg)=>$reg->grade==2&& $reg->exam->exam_type==="редовен");
        $hasFailedCorrectiveExam = $grades->contains(fn($reg) => $reg->grade == 2 && $reg->exam->exam_type === 'поправителен');
        $hasFailedLiquidationExam = $grades->contains(fn($reg) => $reg->grade == 2 && $reg->exam->exam_type === 'ликвидация');
    }
    public function exams(): \Illuminate\Contracts\View\View
    {
        //Get the exams which the student didn't register
        /** @var \App\Models\Student $student */
        $student = Auth::user()->student;
        $registeredExamIds = $student->registrations()->pluck('exam_id');

        $subjectGrades=$student->registrations()
            ->with('exam')
            ->whereNotNull('grade')
            ->get()
             ->groupBy('exam.subject_id');

        $exams=Exam::with(['teacher', 'subject'])
            ->whereHas('subject',function ($q) use ($student){
                $q->where('semester','<=',$student->semester)
                    ->whereHas('specialties',function ($q) use ($student){
                        $q->where('specialty_id',$student->specialty_id);
                    });
            } )
            ->where('start_time', '>', now())
            ->whereNotIn('id', $registeredExamIds)
            ->orderBy('start_time','desc')
            ->get()
            ->filter(function($exam) use ($subjectGrades,$student){
            if($exam->remainingSlots()<=0){
                return false;
            }
            $subjectId=$exam->subject_id;
            $isCurrentSemester=$exam->subject->semester== $student->semester;
            $isPastSemester=$exam->subject->semester<$student->semester;
            if($isCurrentSemester) {
                if (!isset($subjectGrades[$subjectId])) {
                    return $exam->exam_type === 'редовен';
                }

                $grade = $subjectGrades[$subjectId];
                //Check if we have grade over 2(3,...,6)
                $hasPassingGrade = $grade->contains('grade', '>=', 3);
                if ($hasPassingGrade) {
                    return false;
                }
                //Check for regular exam with grade 2
                $hasFailedRegularExam = $grade->contains(function ($registration) {
                    return $registration->grade == 2 && $registration->exam->exam_type === 'редовен';
                });
                $hasFailedCorrectiveExam = $grade->contains(function ($registration) {
                    return $registration->grade == 2 && $registration->exam->exam_type === 'поправителен';
                });

                switch ($exam->exam_type) {
                    case 'редовен':
                        return !$hasFailedRegularExam;
                    case 'поправителен':
                        return $hasFailedRegularExam && !$hasFailedCorrectiveExam;
                    case 'ликвидация':
                        return $hasFailedCorrectiveExam;
                    default:
                        return true;
                }
            }
                if($isPastSemester){
                    if(isset($subjectGrades[$subjectId])){
                        $hasPassingGrade=$subjectGrades[$subjectId]->contains('grade', '>=', 3);
                        if($hasPassingGrade){
                            return false;
                        }
                    }else{
                        return false;
                    }
                    return in_array($exam->exam_type, ['поправителен','ликвидация']);
                }
                return false;
            });

        //Sort the exams by date
//        $sortedExams=$exams->sortBy()

        return view('exams', compact('exams'));
    }
        public function myExams(){
        /** @var \App\Models\Student $student */
        $student = auth()->user()->student;
        $registeredExams=$student->registrations()
            ->with(['exam.teacher', 'exam.subject','exam.hall'])
            ->get()
            ->pluck('exam')
            ->sortByDesc('start_time')
            ->values();


            return view('my_exams',[
                'exams' => $registeredExams,
                'student' => $student
            ]);
        }

    public function register( Exam $exam)
    {
        $student = auth()->user()->student;
        $isPastSemester=$exam->subject->semester<$student->semester;
        if ($exam->remainingSlots() <= 0) {
            return back()->with('error', 'Няма свободни места!');
        }
//        if ($exam->registrations()->where('student_id', auth()->user()->student->id)->exists()) {
        if ($exam->registrations()->where('student_id',$student->id)->exists()){
            return back()->with('error', 'Вече сте записани за този изпит!');
        }
        if($isPastSemester && $exam->exam_type==='редовен'){
            return back()->with('error','Не е позволено да се явяваш на редовни изпити от по-долен курс! Позволено е да се явиш само на поправката или ликвидацията на по-долния курс!');

        }
        if($exam->exam_type==='ликвидация' || $isPastSemester){
            return redirect()->route('payment.handle',['exam'=>$exam]);
        }
        ExamRegistration::create([
            'student_id' => auth()->user()->student->id,
            'exam_id' => $exam->id,
        ]);
        Mail::to( auth()->user()->email)->queue(new SuccessfullyRegistrated($exam, auth()->user()->student));
        Log::debug("aaaaaaaaaaaaaaaaaaa");
        return  redirect()->route('exams')->with('success', 'Успешно се записахте за изпит!');

    }
    public function unregisterExam(Exam $exam,PaymentController $paymentController): \Illuminate\Http\RedirectResponse
    {
        $student=auth()->user()->student;
        $isPastSemester=$exam->subject->semester<$student->semester;

        $registration=ExamRegistration::where('student_id',$student->id)
            ->where('exam_id',$exam->id)->first();

        if(!$registration){
            return back()->with("error","Не може да се опишете, защото не сте записани за този изпит!");
        }
        if($exam->start_time->isPast()){
            return back()->with("error","Отписването е невъзможно, тъй като изпита вече е минал");
        }

        if($exam->start_time->diffInHours(now(),true)<48){
            return back()->with("error","Отисването от дадения изпит е невъзможно по-малко от 48 часа преди изпита");
        }

        if(($exam->exam_type==="ликвидация"||$isPastSemester)&&$registration->payment){
//            $payment=Payment::where('exam_registration_id',$registration->id)
//            ->where('student_id',\auth()->user()->student->id)->first();
//            if($payment && $payment->status === "paid"){
                $refundSuccess=$this->paymentService->processRefund($registration->payment->stripe_payment_id,"requested_by_customer");
                if(!$refundSuccess){
                    return back()->with('error',"Грешка при връщането на парите");
                }

            }
        $registration->delete();
        return back()->with("success","Успешно се отписахте от изпита");
    }

}


