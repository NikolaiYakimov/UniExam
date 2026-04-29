<?php

namespace App\Http\Controllers;

use App\DTOs\UpdatePasswordDto;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\User\UserProfileService;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    public function __construct(private readonly UserProfileService $userProfileService){}
    public function update(UpdatePasswordRequest $request):JsonResponse{
        $dto = UpdatePasswordDto::fromRequest($request);
        $this->userProfileService->updatePassword($request->user(), $dto);
        return response()->json(
            [
                'success' => true,
                'message' => 'Паролата е сменена успешно',
            ]
        );
    }
}
