<?php

namespace App\Http\Controllers;

use App\DTOs\CreateUserDto;
use App\DTOs\UpdateUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserListResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\AdminUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{


    public function __construct(private readonly AdminUserService $userService)
    {}

    public function getUsers(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return response()->json([
            'success' => true,
            'data' => UserListResource::collection($users)
        ]);
    }

    public function create()
    {
        $formOptions=$this->userService->getFormOptions();

        return response()->json([
            'success' => true,
            'faculties' => $formOptions['faculties'],
            'specialties' => $formOptions['specialties'],
            'groups' => $formOptions['groups']
        ]);
    }


    public function store(UserRequest $request)
    {
        $dto = CreateUserDto::fromRequest($request);
        $user = $this->userService->createUser($dto);

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е създаден успешно.',
            'data' => new UserResource($user),
        ], 201);
    }
    public function edit($id)
    {

        $user = $this->userService->getUserWithRoleData($id);

        $formOptions=$this->userService->getFormOptions();


        return response()->json([
            'success' => true,
            'data'=>new UserResource($user),
            'faculties' => $formOptions['faculties'],
            'specialties' => $formOptions['specialties'],
            'groups' => $formOptions['groups']
        ]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        $dto = UpdateUserDto::fromRequest($request);
        $user = $this->userService->updateUser($user->id, $dto);

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е актуализиран успешно.',
            'data' => new UserResource($user)
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е изтрит успешно.'
        ]);
    }

}
