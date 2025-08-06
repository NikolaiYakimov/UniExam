<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Artisan::command('students:update-semesters', function () {
//    \Log::info('Командата students:update-semesters се изпълнява!');
//    $this->comment('Командата students:update-semesters работи.');
//});
