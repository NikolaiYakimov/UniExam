<?php

namespace App\Console\Commands;

use App\Services\SchedulerServices\SemesterService;
use Illuminate\Console\Command;

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
        $this->info('Semester has been updated');
    }else{
        $this->info('Semester not updated, no need of this now!');
    }
    }

}
