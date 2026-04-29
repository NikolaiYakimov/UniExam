<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\User\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request, UserProfileService $service):JsonResponse
    {
        $dto = UpdateProfileDto::fromRequest($request);
        $service->updateProfile($request->user(), $dto);

        return response()->json(['success' => 'Успешмпо актуализирахте профила си']);
    }
}
