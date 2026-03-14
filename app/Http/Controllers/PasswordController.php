<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    public function __construct(private readonly UserService $userService){}
    public function update(UpdatePasswordRequest $request):JsonResponse{
        $this->userService->updatePassword($request->user(),$request->validated());
        return response()->json(
            [
                'success' => true,
                'message' => 'Паролата е сменена успешно',
            ]
        );
    }
}
