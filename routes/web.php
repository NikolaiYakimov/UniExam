<?php

use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('student_login');
});

//Route::prefix('student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login.form');
    Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login');
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

    Route::middleware(['auth:student'])->group(function () {
        Route::get('/exams', [StudentController::class, 'exams'])->name('exams');
        Route::post('/exams/{exam}/register', [StudentController::class, 'register'])->name('student.exam.register');
    });

//});
