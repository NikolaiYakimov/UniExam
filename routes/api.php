<?php


//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\UserController;
//use Illuminate\Support\Facades\Route;

//Route::post('/login', [AuthController::class, 'apiLogin']);
//Route::post('/logout', [AuthController::class, 'apiLogout'])->middleware('auth:sanctum');
////Route::post('/register', [AuthController::class, 'apiRegister']); // ако е необходимо
//
//// Password reset routes
////Route::post('forgot-password', [UserController::class, 'apiSendResetLinkEmail']);
////Route::post('reset-password', [UserController::class, 'apiReset']);
//
//// Protected routes
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/user', function (Request $request) {
//        return $request->user();
//    });
//
//    // Добавете другите API routes тук
//});


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/logout', [AuthController::class, 'apiLogout'])->middleware('auth:sanctum');
Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])
    ->name('payment.success.embedded'); // нужно за PaymentService::createCheckoutSession

Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])
    ->name('payment.cancel');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'getUserWithRelations']);
    Route::get('/exams', [ExamController::class, 'exams'])->name('exams');
    Route::post('/exams/{exam}/register', [ExamRegistrationController::class, 'register']);
    Route::get('/user-with-relations', [UserController::class, 'getUserWithRelations'])->middleware('auth:sanctum');
//    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment']);
    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment'])
        ->name('payment.handle'); // нужно е за места, където се ползва route('payment.handle')
    Route::get('/my-exams', [ExamRegistrationController::class, 'myExams']);
    Route::get('/my-past-exams', [ExamRegistrationController::class, 'myPastExam'])->name('my_past_exams');
    Route::post('/exams/{exam}/unregister', [ExamRegistrationController::class, 'unregisterExam']);
    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');

    Route::get('/student-profile', [StudentController::class, 'getStudentProfile'])->name('student.profile');
    Route::get('/student-profile--profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/student-profile-profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/student-profile/password', [UserController::class, 'updatePassword'])->name('profile.password');


    Route::get('/upcoming_exams', [ExamController::class, 'teacherUpcomingExams'])
//        ->name('upcoming_exams');
        ->name('teacher_dashboard');

    Route::get('/conducted-exams', [ExamController::class, 'conductedExams'])
        ->name('conducted_exams');

    Route::get('/booked-slots', [ExamController::class, 'getBookedSlots'])
        ->name('exams.booked-slots');

    Route::post('/examStore', [ExamController::class, 'storeExam'])
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
//    Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])
//        ->name('payment.success.embedded'); // нужно за PaymentService::createCheckoutSession
//
//    Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])
//        ->name('payment.cancel');
    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');
});
