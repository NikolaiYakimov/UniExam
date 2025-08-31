<?php

namespace App\Console\Commands;

use App\Services\SchedulerServices\AutoRegistrationService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StudentAutoRegistration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:student-auto-registration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically register students with attestation for exams on the exam day if they are not registered already';

    /**
     * Execute the console command.
     */
    public function handle(AutoRegistrationService $autoRegistrationService)
    {
        $this->info('Starting auto-registration of walk-in students...');

        $registeredCount = $autoRegistrationService->autoRegistrationForExam();

        $this->info("Auto-registration completed. Registered {$registeredCount} students.");

    }
}
