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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/logout', [AuthController::class, 'apiLogout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/exams', [ExamController::class, 'exams']);
    Route::post('/exams/{exam}/register', [ExamController::class, 'apiRegister']);
});
