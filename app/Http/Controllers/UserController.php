<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetNewPasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserRequest;
use App\Mail\PasswordChangedMail;
use App\Mail\PasswordResetMail;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Subject;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;


class UserController extends Controller
{


    public function __construct(private readonly UserService $userService)
    {}

    public function getUsers(): JsonResponse
    {
        $users = $this->userService->getAllUsers();
        return response()->json([
            'success' => true,
            'data' => $users
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

        $data=$request->validated();
        $user = $this->userService->createUser($data);


        return response()->json([
            'success' => true,
            'message' => 'Потребителят е създаден успешно.',
            'data' => $user,
//            'subjects_attached' => $subjects->count() ?? 0
        ], 201);
    }
    public function edit($id)
    {

        $user = $this->userService->getUserWithRoleData($id);

        $formOptions=$this->userService->getFormOptions();


        return response()->json([
            'success' => true,
//            'data' => $user,
            'data'=>new UserResource($user),
            'faculties' => $formOptions['faculties'],
            'specialties' => $formOptions['specialties'],
            'groups' => $formOptions['groups']
        ]);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {

        $data=$request->validated();
        $user = $this->userService->updateUser($user->id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Потребителят е актуализиран успешно.',
            'data' => $user
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

//    public function getUserWithRelations(Request $request)
//    {
//        $user = $request->user();
//
//        if ($user->role === 'student') {
//            $user->load('student.faculty', 'student.specialty', 'student.group');
//        } elseif ($user->role === 'teacher') {
//            $user->load('teacher.faculty', 'teacher.specialty');
//        } elseif ($user->role === 'administrator') {
//            $user->load('administrator');
//        }
//
//        return response()->json($user);
//    }

}

