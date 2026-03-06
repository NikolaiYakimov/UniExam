<?php
//
//
////use App\Http\Controllers\AuthController;
////use App\Http\Controllers\UserController;
////use Illuminate\Support\Facades\Route;
//
////Route::post('/login', [AuthController::class, 'apiLogin']);
////Route::post('/logout', [AuthController::class, 'apiLogout'])->middleware('auth:sanctum');
//////Route::post('/register', [AuthController::class, 'apiRegister']); // ако е необходимо
////
////// Password reset routes
//////Route::post('forgot-password', [UserController::class, 'apiSendResetLinkEmail']);
//////Route::post('reset-password', [UserController::class, 'apiReset']);
////
////// Protected routes
////Route::middleware('auth:sanctum')->group(function () {
////    Route::get('/user', function (Request $request) {
////        return $request->user();
////    });
////
////    // Добавете другите API routes тук
////});
//
//
//use App\Http\Controllers\AdminSubjectController;
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\ExamController;
//use App\Http\Controllers\ExamHallController;
//use App\Http\Controllers\ExamRegistrationController;
//use App\Http\Controllers\FacultyController;
//use App\Http\Controllers\PaymentController;
//use App\Http\Controllers\SpecialtyController;
//use App\Http\Controllers\StudentController;
//use App\Http\Controllers\SubjectController;
//use App\Http\Controllers\TeacherController;
//use App\Http\Controllers\UserController;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
//Route::post('/login', [AuthController::class, 'apiLogin']);
//Route::post('/logout', [AuthController::class, 'apiLogout'])->middleware('auth:sanctum');
//Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])
//    ->name('payment.success.embedded'); // нужно за PaymentService::createCheckoutSession
//
//Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])
//    ->name('payment.cancel');
//
//Route::post('/password/email', [UserController::class, 'sendResetLinkEmail']);
//Route::post('/password/reset', [UserController::class, 'reset']);
//
//Route::middleware('auth:sanctum')->group(function () {
//
//    Route::get('/user', [AuthController::class, 'getUserWithRelations']);
//    Route::get('/exams', [ExamController::class, 'exams'])->name('exams');
//    Route::post('/exams/{exam}/register', [ExamRegistrationController::class, 'register']);
//    Route::get('/user-with-relations', [UserController::class, 'getUserWithRelations'])->middleware('auth:sanctum');
////    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment']);
//    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment'])
//        ->name('payment.handle'); // нужно е за места, където се ползва route('payment.handle')
//    Route::get('/my-exams', [ExamRegistrationController::class, 'myExams']);
//    Route::get('/my-past-exams', [ExamRegistrationController::class, 'myPastExam'])->name('my_past_exams');
//    Route::post('/exams/{exam}/unregister', [ExamRegistrationController::class, 'unregisterExam']);
//    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');
//
//    Route::get('/student-profile', [StudentController::class, 'getStudentProfile'])->name('student.profile');
//    Route::get('/student-profile--profile', [UserController::class, 'edit'])->name('profile.edit');
//    Route::put('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update');
//    Route::put('/student-profile/password', [UserController::class, 'updatePassword'])->name('profile.password');
//
//
//    Route::get('/upcoming_exams', [ExamController::class, 'teacherUpcomingExams'])
////        ->name('upcoming_exams');
//        ->name('teacher_dashboard');
//    Route::get('/exam/{exam}/registered-students',[ExamController::class, 'examRegisteredStudents'])->name('student.exams');
//
//    Route::get('/conducted-exams', [ExamController::class, 'conductedExams'])
//        ->name('conducted_exams');
//
//    Route::get('/booked-slots', [ExamController::class, 'getBookedSlots'])
//        ->name('exams.booked-slots');
//
//    Route::post('/examStore', [ExamController::class, 'storeExam'])
//        ->name('exams.store');
//
//    Route::get('/exam/{id}/edit-data', [ExamController::class, 'getExamEditData'])
//        ->name('exams.edit-data');
//
//    Route::put('/edit-exams/{examId}', [ExamController::class, 'editExam'])
//        ->name('exams.update');
//
//    Route::get('/exam/{exam}',[ExamController::class,'examDetails'])
//        ->name('teacher.exam.details');
//
//    Route::post('/exam/{exam}/grades', [ExamRegistrationController::class, 'updateGrades'])
//        ->name('teacher.exam.grades.update');
//
//   ///____
//    Route::get('/teacher-subjects', [SubjectController::class, 'getTeacherSubjects'])
//        ->name('teacher.subjects');
//
//    Route::get('/subjects/{subject}/students', [SubjectController::class, 'showSubjectStudents'])
//        ->name('teacher.subject.students');
//
//    Route::post('/subjects/{subject}/students/{student}/toggle-attestation', [SubjectController::class, 'toggleAttestation'])
//        ->name('teacher.subject.toggle_attestation');
//
//    Route::get('/teacher-profile', [TeacherController::class, 'getTeacherProfile'])->name('teacher.profile');
////    Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])
////        ->name('payment.success.embedded'); // нужно за PaymentService::createCheckoutSession
////
////    Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])
////        ->name('payment.cancel');
//    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');
//
//    Route::get('/subjects', [AdminSubjectController::class, 'uniSubjects'])->name('admin.subjects.uni_subjects');
//    Route::get('/subjects/create', [AdminSubjectController::class, 'create'])->name('admin.subjects.create');
//    Route::post('/subjects', [AdminSubjectController::class, 'store'])->name('admin.subjects.store');
//    Route::get('/subjects/{subject}/edit', [AdminSubjectController::class, 'edit'])->name('admin.subjects.edit');
//    Route::put('/subjects/{subject}', [AdminSubjectController::class, 'update'])->name('admin.subjects.update');
//    Route::delete('/subjects/{subject}', [AdminSubjectController::class, 'destroy'])->name('admin.subjects.destroy');
//
//
//    Route::get('/users', [UserController::class, 'getUsers'])->name('admin.users.uni_users');
//    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
//    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
//    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
//    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
//    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
//
////    Route::get('/exam-halls', [ExamHallController::class, 'getExamHalls'])->name('admin.exam-halls.index');
//
//    Route::get('/exam-halls', [ExamHallController::class, 'getExamHalls']);
//    Route::post('/exam-halls/store', [ExamHallController::class, 'store'])->name('admin.exam-halls.store');
//    Route::get('/exam-halls/{examHall}/edit', [ExamHallController::class, 'edit'])->name('admin.exam-halls.show');
//    Route::put('/exam-halls/{examHall}', [ExamHallController::class, 'update'])->name('admin.exam-halls.update');
//    Route::delete('/exam-halls/{examHall}', [ExamHallController::class, 'destroy'])->name('admin.exam-halls.destroy');
//
//    Route::get('/faculties', [FacultyController::class, 'getFaculties']);
//    Route::post('/faculties/store', [FacultyController::class, 'store']);
//    Route::get('/faculties/{id}/edit', [FacultyController::class, 'edit']);
//    Route::put('/faculties/{id}', [FacultyController::class, 'update']);
//    Route::delete('/faculties/{id}', [FacultyController::class, 'destroy']);
//
//    Route::get('/specialties', [SpecialtyController::class, 'getSpecialties']);
//    Route::post('/specialties/store', [SpecialtyController::class, 'store']);
//    Route::get('/specialties/{id}/edit', [SpecialtyController::class, 'edit']);
//    Route::put('/specialties/{id}', [SpecialtyController::class, 'update']);
//    Route::delete('/specialties/{id}', [SpecialtyController::class, 'destroy']);
//
//});


use App\Http\Controllers\AdminSubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamHallController;
use App\Http\Controllers\ExamHallSlotController;
use App\Http\Controllers\ExamRegistrationController;
use App\Http\Controllers\ExamStudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherExamController;
use App\Http\Controllers\TeacherGradeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [PasswordResetLinkController::class, 'store']);
Route::post('/password/reset', [NewPasswordController::class, 'store']);

Route::get('/exams/payment/success', [PaymentController::class, 'paymentSuccess'])
    ->name('payment.success.embedded');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])
    ->name('payment.cancel');

// Student routes
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
//    Route::get('/exams', [ExamController::class, 'exams'])->name('exams');
    //TODO possibly can change the url to /student/exams
    Route::get('/exams', [StudentExamController::class, 'index'])->name('exams');
    Route::post('/exams/{exam}/register', [ExamRegistrationController::class, 'register']);
    Route::get('/my-exams', [ExamRegistrationController::class, 'myExams']);
    Route::get('/my-past-exams', [ExamRegistrationController::class, 'pastExam'])->name('my_past_exams');
    Route::post('/exams/{exam}/unregister', [ExamRegistrationController::class, 'unregisterExam']);
    Route::get('/payments', [PaymentController::class, 'student_payments'])->name('payments.student_payments');
    Route::get('/student-profile', [StudentController::class, 'getStudentProfile'])->name('student.profile');
    Route::post('/exams/payment/{exam}', [PaymentController::class, 'handlePayment'])->name('payment.handle');
});

// Teacher routes
Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
//    Route::get('/upcoming_exams', [ExamController::class, 'teacherUpcomingExams'])->name('teacher_dashboard');
    Route::get('/upcoming_exams', [TeacherExamController::class, 'upcomingExam'])->name('teacher_dashboard');

//    Route::get('/exam/{exam}/registered-students', [ExamController::class, 'examRegisteredStudents'])->name('student.exams');
    Route::get('/exam/{exam}/registered-students', [ExamStudentController::class, 'index'])->name('student.exams');
//    Route::get('/conducted-exams', [ExamController::class, 'conductedExams'])->name('conducted_exams');
    Route::get('/conducted-exams', [TeacherExamController::class, 'conducted'])->name('conducted_exams');
//    Route::get('/booked-slots', [ExamController::class, 'getBookedSlots'])->name('exams.booked-slots');
    Route::get('/booked-slots', [ExamHallSlotController::class, 'index'])->name('exams.booked-slots');

//    Route::post('/examStore', [ExamController::class, 'storeExam'])->name('exams.store');
    Route::post('/examStore', [TeacherExamController::class, 'store'])->name('exams.store');

//    Route::get('/exam/{id}/edit-data', [ExamController::class, 'getExamEditData'])->name('exams.edit-data');

    //We don't use it for now
    Route::get('/exam/{id}/edit-data', [TeacherExamController::class, 'edit'])->name('exams.edit-data');
//    Route::put('/edit-exams/{examId}', [ExamController::class, 'editExam'])->name('exams.update');
    Route::put('/edit-exams/{examId}', [TeacherExamController::class, 'update'])->name('exams.update');
//    Route::get('/exam/{exam}', [ExamController::class, 'examDetails'])->name('teacher.exam.details');
    Route::get('/exam/{exam}', [TeacherExamController::class, 'show'])->name('teacher.exam.details');

//    Route::post('/exam/{exam}/grades', [ExamRegistrationController::class, 'updateGrades'])->name('teacher.exam.grades.update');
    Route::post('/exam/{exam}/grades', [TeacherGradeController::class, 'update'])->name('teacher.exam.grades.update');
    Route::get('/teacher-subjects', [SubjectController::class, 'getTeacherSubjects'])->name('teacher.subjects');
    Route::get('/subjects/{subject}/students', [SubjectController::class, 'showSubjectStudents'])->name('teacher.subject.students');
    Route::post('/subjects/{subject}/students/{student}/toggle-attestation', [SubjectController::class, 'toggleAttestation'])->name('teacher.subject.toggle_attestation');
    Route::get('/teacher-profile', [TeacherController::class, 'getTeacherProfile'])->name('teacher.profile');
});

// Administrator routes
Route::middleware(['auth:sanctum', 'role:administrator'])->group(function () {
    Route::get('/subjects', [AdminSubjectController::class, 'uniSubjects'])->name('admin.subjects.uni_subjects');
    Route::get('/subjects/create', [AdminSubjectController::class, 'create'])->name('admin.subjects.create');
    Route::post('/subjects', [AdminSubjectController::class, 'store'])->name('admin.subjects.store');
    Route::get('/subjects/{subject}/edit', [AdminSubjectController::class, 'edit'])->name('admin.subjects.edit');
    Route::put('/subjects/{subject}', [AdminSubjectController::class, 'update'])->name('admin.subjects.update');
    Route::delete('/subjects/{subject}', [AdminSubjectController::class, 'destroy'])->name('admin.subjects.destroy');

    Route::get('/users', [UserController::class, 'getUsers'])->name('admin.users.uni_users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/exam-halls', [ExamHallController::class, 'getExamHalls']);
    Route::post('/exam-halls/store', [ExamHallController::class, 'store'])->name('admin.exam-halls.store');
    Route::get('/exam-halls/{examHall}/edit', [ExamHallController::class, 'edit'])->name('admin.exam-halls.show');
    Route::put('/exam-halls/{examHall}', [ExamHallController::class, 'update'])->name('admin.exam-halls.update');
    Route::delete('/exam-halls/{examHall}', [ExamHallController::class, 'destroy'])->name('admin.exam-halls.destroy');

    Route::get('/faculties', [FacultyController::class, 'getFaculties']);
    Route::post('/faculties/store', [FacultyController::class, 'store']);
    Route::get('/faculties/{id}/edit', [FacultyController::class, 'edit']);
    Route::put('/faculties/{id}', [FacultyController::class, 'update']);
    Route::delete('/faculties/{id}', [FacultyController::class, 'destroy']);

    Route::get('/specialties', [SpecialtyController::class, 'getSpecialties']);
    Route::post('/specialties/store', [SpecialtyController::class, 'store']);
    Route::get('/specialties/{id}/edit', [SpecialtyController::class, 'edit']);
    Route::put('/specialties/{id}', [SpecialtyController::class, 'update']);
    Route::delete('/specialties/{id}', [SpecialtyController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUserWithRelations']);
//    Route::get('/user-with-relations', [UserController::class, 'getUserWithRelations']);
//    Route::get('/student-profile--profile', [UserController::class, 'edit'])->name('profile.edit');
//    Route::put('/profile-update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/user/password', [PasswordController::class, 'update'])->name('profile.password');
});
