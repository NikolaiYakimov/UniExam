<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('student_login');
});

//Route::prefix('student')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:student'])->group(function () {
        Route::get('/exams', [StudentController::class, 'exams'])->name('exams');
        Route::get('/my_exams', [StudentController::class, 'myExams'])->name('my_exams');
        Route::post('/exams/{exam}/register', [StudentController::class, 'register'])->name('student.exam.register');

    });

    Route::middleware(['auth:teacher'])->group(function () {


    });

//});
