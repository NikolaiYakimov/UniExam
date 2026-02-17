<?php

namespace App\Http\Controllers;

use App\DTOs\UpdateProfileDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\PasswordChangedMail;
use App\Mail\PasswordResetMail;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
use App\Models\Subject;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsers()
    {
        $users = $this->userService->getAllUsers();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function create()
    {
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();

        return response()->json([
            'success' => true,
            'faculties' => $faculties,
            'specialties' => $specialties,
            'groups' => $groups
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:student,teacher,administrator',
            'faculty_number' => 'required_if:role,student',
            'faculty_id' => 'nullable|exists:faculties,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'semester' => 'nullable|integer|min:1|max:8',
            'group_id' => 'nullable|exists:groups,id',
            'title' => 'required_if:role,teacher'
        ]);

        $user = $this->userService->createUser($data);


        if ($data['role'] === 'student' && !empty($data['specialty_id']) && !empty($data['semester'])) {
            try {
                $subjects = Subject::where('semester', $data['semester'])
                    ->whereHas('specialties', function ($query) use ($data) {
                        $query->where('specialties.id', $data['specialty_id']);
                    })
                    ->get();

                if ($subjects->count() > 0) {
                    $user->load('student');
                    $user->student->subjects()->attach($subjects, ['has_attestation' => true]);

                }
            } catch (\Exception $e) {
                \Log::error('Грешка при свързване на предмети за студент: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е създаден успешно.',
            'data' => $user,
            'subjects_attached' => $subjects->count() ?? 0
        ], 201);
    }
    public function edit($id)
    {

        $user = $this->userService->getUserWithRoleData($id);
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();


        return response()->json([
            'success' => true,
            'data' => $user,
            'faculties' => $faculties,
            'specialties' => $specialties,
            'groups' => $groups
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:student,teacher,administrator',
            'faculty_number' => 'required_if:role,student',
            'faculty_id' => 'nullable|exists:faculties,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'semester' => 'nullable|integer|min:1|max:8',
            'group_id' => 'nullable|exists:groups,id',
            'title' => 'required_if:role,teacher'

        ]);

        $user = $this->userService->updateUser($id, $data);

        if ($data['role'] === 'student' && !empty($data['specialty_id']) && !empty($data['semester'])) {
            try {
                $student = $user->student;
                if ($student) {

                    $newSubjects = Subject::where('semester', $data['semester'])
                        ->whereHas('specialties', function ($query) use ($data) {
                            $query->where('specialties.id', $data['specialty_id']);
                        })
                        ->get();

                    if ($newSubjects->count() > 0) {
                        $existingSubjectIds = $student->subjects()->pluck('subjects.id')->toArray();

                        $subjectsToAttach = $newSubjects->filter(function ($subject) use ($existingSubjectIds) {
                            return !in_array($subject->id, $existingSubjectIds);
                        });

                        if ($subjectsToAttach->count() > 0) {
                            $student->subjects()->attach($subjectsToAttach, ['has_attestation' => true]);

                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Грешка при актуализиране на предмети за студент: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е актуализиран успешно.',
            'data' => $user
        ]);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return response()->json([
            'success' => true,
            'message' => 'Потребителят е изтрит успешно.'
        ]);
    }


     public function updateProfile(UpdateProfileRequest $request,UserService $service){

        $dto=UpdateProfileDto::fromRequest($request);
        $service->updateProfile($request->user(),$dto);


         return response()->json(['success' => 'Успешмпо актуализирахте профила си']);

     }
     public function updatePassword(UpdatePasswordRequest $request,UserService $service)
     {

         $service->updatePassword($request->user(),$request->validated());
         try{
             if(!empty($user->email)){
                 Mail::to($user->email)->queue(new PasswordChangedMail($user,now()));
             }
         }catch (\Throwable $e){
             \Log::warning('failed to send PasswordChangedMail');
         }

         return response()->json(['success'=>'Паролата е сменена успешно']);

     }


    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {

            return  response()->json(['message'=>'Потребител с този имейл не съществува'],404);
        }


        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );
        try {
            Mail::to($request->email)->queue(new PasswordResetMail($token, $user));
        }catch (\Exception $e){
            return response()->json(["Грешка!Възникна грешка при изпращането на имейла!"],500);
        }

        return response()->json(['message' => 'Изпратихме ви имейл с линк за възстановяване на паролата!'
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {

            return response()->json(['message'=>'Токенът който беше предоставен е невалиден!',500]);
        }


        if (now()->diffInMinutes($resetRecord->created_at) > 60) {

            return response()->json(['message'=>'Токенът ви е изтекъл.Опитайте отново!'],400);
        }


        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();


        DB::table('password_resets')->where('email', $request->email)->delete();


        try {
            if (!empty($user->email)) {
                Mail::to($user->email)->queue(new PasswordChangedMail($user, now()));
            }
        } catch (\Throwable $e) {
            Log::warning('Грешка при изпращане');
        }


        return response()->json(['message'=>'Паролата ви е променена успешно!']);
    }
    public function getUserWithRelations(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'student') {
            $user->load('student.faculty', 'student.specialty', 'student.group');
        } elseif ($user->role === 'teacher') {
            $user->load('teacher.faculty', 'teacher.specialty');
        } elseif ($user->role === 'administrator') {
            $user->load('administrator');
        }

        return response()->json($user);
    }

}

