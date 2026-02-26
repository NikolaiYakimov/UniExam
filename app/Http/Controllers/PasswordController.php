<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{


    public function update(UpdatePasswordRequest $request,UserService $userService):JsonResponse{
        $userService->updatePassword($request->user(),$request->validated());
        return response()->json(
            [
                'success' => true,
                'message' => 'Паролата е сменена успешно',
            ]
        );
    }
}
