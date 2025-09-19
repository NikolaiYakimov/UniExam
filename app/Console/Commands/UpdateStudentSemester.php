<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Services\SchedulerServices\SemesterService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class  UpdateStudentSemester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:update-semesters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increase semester of the students if new winter or summer semester start ';

    /**
     * Execute the console command.
     */

    protected $semesterService;
    public function __construct(SemesterService $semesterService)
    {
       parent::__construct();
       $this->semesterService = $semesterService;
    }

    public function handle()
    {
        \Log::info('Командата update-semesters стартира');
        if($this->semesterService->updateCurrentSemester()){
            $this->enrollStudentsInTheNewSemesterSubjects();
            $this->info('Семестъра беше променен и студентите бяха записани в новите им предмети');
        }else{
            $this->info('Семестъра не беше променен!');
        }
    }

    public function enrollStudentsInTheNewSemesterSubjects()
    {
        $students=Student::with('specialty.subjects')->get();

        foreach($students as $student){
            $specialty = $student->specialty;
            if(!$specialty){
                Log::warning("Студента не е в нито една спецялност");
                continue;
            }
            $newSemesterSubjects= $specialty->subjects()->where('semester',$student->semester)->get();
            foreach($newSemesterSubjects as $subject){
                if(!$student->subjects()->where('subject_id',$subject->id)->exists()){
                    $student->subjects()->attach($subject->id);
                    Log::info("Студента  {$student->first_name} {$student->last_name} беше зашосан за предмет {$subject->name}");
                }
            }
        }
        $this->info("Студентите бяха записани за новите им предмети");
    }

}
