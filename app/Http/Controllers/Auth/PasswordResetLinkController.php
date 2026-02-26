<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;

class PasswordResetLinkController extends Controller
{
    public function store(ForgotPasswordRequest $request,PasswordResetService $passwordResetService):JsonResponse{
        $isSent=$passwordResetService->sendResetLink($request->validated('email'));
        if(!$isSent){
            return response()->json([
                'message' => 'Възникна проблем при изпращането на имейла. Моля, опитайте по-късно!'
            ], 500);
        }
        return response()->json([
            'message' => 'Изпратихме ви имейл с линк за възстановяване на паролата!'
        ], 200);
        }

}

