<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user_login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Student routes
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/exams', [StudentController::class, 'exams'])->name('exams');
    Route::get('/my_exams', [StudentController::class, 'myExams'])->name('my_exams');
    Route::post('/exams/{exam}/register', [StudentController::class, 'register'])->name('student.exam.register');
});

// Teacher routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher_dashboard', [TeacherController::class, 'dashboard'])->name('teacher_dashboard');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/booked-slots', [ExamController::class, 'getBookedSlots'])->name('exams.booked-slots');
});

// Administrator routes
Route::prefix('administrator')->middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

