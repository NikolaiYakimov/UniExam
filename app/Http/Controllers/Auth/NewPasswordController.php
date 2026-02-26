<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetNewPasswordRequest;
use App\Services\PasswordResetService;

class NewPasswordController extends Controller
{
    public function store(ResetNewPasswordRequest $request,PasswordResetService $passwordResetService)
    {
        $data = $request->validated();
        $result=$passwordResetService->resetPassword($data['token'],$data['email'],$data['password']);
        return match ($result){
            'invalid_token'=>response()->json([
                'message'=>'Токенът който беше предоставен е невалиден!'
            ],400),
            'expired_token'=>response()->json([
                'message'=>'Токенът ви е изтекъл. Опитайте отново!'
            ],400),
            default=>response()->json([
                'message'=>'Паролата ви е променена успешно!'
            ])
        };
    }
}
