<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('students:update-semesters')->daily();
//Artisan::command('students:update-semesters', function () {
//    \Log::info('Командата students:update-semesters се изпълнява!');
//    $this->comment('Командата students:update-semesters работи.');
//});

