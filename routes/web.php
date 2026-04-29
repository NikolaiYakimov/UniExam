<?php

use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

// Serve React app for all non-API routes
Route::get('/{any?}', function () {
    return view('app');
})->where('any', '^(?!api).*$');


