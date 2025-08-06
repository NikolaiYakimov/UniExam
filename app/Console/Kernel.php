<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdateStudentSemester::class,
    ];


    protected function schedule(Schedule $schedule)
    {
        dd('Kernel schedule method is reached!');
        Log::info('Schedule method was called'); // това трябва да се види в логовете
        $schedule->command('inspire')->everyMinute();

        $schedule->command('students:update-semesters')
            ->everyMinute()
            ->description('Проба за scheduler');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
