<?php

use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StripeWebhookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('user_login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [UserController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [UserController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/edit', [UserController::class, 'editAccount'])->name('profile.edit');

});

// Stripe webhook
Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');

// Student routes
Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/exams', [ExamController::class, 'exams'])->name('exams');
    Route::get('/my_exams', [ExamRegistrationController::class, 'myExams'])->name('my_exams');
    Route::get('/my_past_exams', [ExamRegistrationController::class, 'myPastExam'])->name('my_past_exams');
    Route::post('/exams/{exam}/register', [ExamRegistrationController::class, 'register'])->name('student.exam.register');
    Route::post('/exams/{exam}/unregister', [ExamRegistrationController::class, 'unregisterExam'])->name('student.exam.unregister');

    Route::get('/student-profile', [StudentController::class, 'getStudentProfile'])->name('student.profile');
//    Route::get('/student-profile--profile', [UserController::class, 'edit'])->name('profile.edit');
//    Route::put('/student-profile-profile', [UserController::class, 'updateProfile'])->name('profile.update');
//    Route::put('/student-profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

//    Route::get('/exams/payment/{exam}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment'])->name('payment.handle');
    Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success.embedded');
    Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');
});

// Teacher routes
Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/upcoming_exams', [ExamController::class, 'teacherUpcomingExams'])
//        ->name('upcoming_exams');
        ->name('teacher_dashboard');

    Route::get('/conducted-exams', [ExamController::class, 'conductedExams'])
        ->name('conducted_exams');

    Route::get('/booked-slots', [ExamController::class, 'getBookedSlots'])
        ->name('exams.booked-slots');

    Route::post('/exams', [ExamController::class, 'storeExam'])
        ->name('exams.store');

    Route::get('/exam/{id}/edit-data', [ExamController::class, 'getExamEditData'])
        ->name('exams.edit-data');

    Route::put('/edit-exams/{examId}', [ExamController::class, 'editExam'])
        ->name('exams.update');

    Route::get('/exam/{exam}',[ExamController::class,'examDetails'])
        ->name('teacher.exam.details');

    Route::post('/exam/{exam}/grades', [ExamController::class, 'updateGrades'])
        ->name('teacher.exam.grades.update');

   ///____
    Route::get('/subjects', [SubjectController::class, 'getTeacherSubjects'])
        ->name('teacher.subjects');

    Route::get('/subjects/{subject}/students', [SubjectController::class, 'showSubjectStudents'])
        ->name('teacher.subject.students');

    Route::post('/subjects/{subject}/students/{student}/toggle-attestation', [SubjectController::class, 'toggleAttestation'])
        ->name('teacher.subject.toggle_attestation');

    Route::get('/teacher-profile', [TeacherController::class, 'getTeacherProfile'])->name('teacher.profile');
});

// Administrator routes
Route::prefix('administrator')->middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/subjects', [AdminSubjectController::class, 'uniSubjects'])->name('admin.subjects.uni_subjects');
    Route::get('/subjects/create', [AdminSubjectController::class, 'create'])->name('admin.subjects.create');
    Route::post('/subjects', [AdminSubjectController::class, 'store'])->name('admin.subjects.store');
    Route::get('/subjects/{subject}/edit', [AdminSubjectController::class, 'edit'])->name('admin.subjects.edit');
    Route::put('/subjects/{subject}', [AdminSubjectController::class, 'update'])->name('admin.subjects.update');
    Route::delete('/subjects/{subject}', [AdminSubjectController::class, 'destroy'])->name('admin.subjects.destroy');

    Route::get('/users', [UserController::class, 'getUsers'])->name('admin.users.uni_users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');


});

