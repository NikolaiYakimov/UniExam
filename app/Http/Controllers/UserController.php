<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\PasswordChangedMail;
use App\Mail\PasswordResetMail;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Specialty;
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
        return view('users', compact('users'));
//        return response()->json([
//            'success' => true,
//            'data' => $users
//        ]);
    }

    public function create()
    {
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();
        return view('create_user', compact('faculties', 'specialties', 'groups'));
//        return response()->json([
//            'success' => true,
//            'faculties' => $faculties,
//            'specialties' => $specialties,
//            'groups' => $groups
//        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:student,teacher,administrator',
            'faculty_number' => 'required_if:role,student',
            'faculty_id' => 'nullable|exists:faculties,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'semester' => 'nullable|integer|min:1|max:8',
            'group_id' => 'nullable|exists:groups,id',
            'title' => 'required_if:role,teacher'
        ]);

        $user = $this->userService->createUser($request->all());

        $user = $this->userService->createUser($data);
//        return response()->json([
//            'success' => true,
//            'message' => 'Потребителят е създаден успешно.',
//            'data' => $user
//        ], 201);
        return redirect()->route('admin.users.uni_users')->with('success', 'Потребителят е създаден успешно.');
    }

    public function edit($id)
    {

        $user = $this->userService->getUserWithRoleData($id);
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();

        return view('edit_user', compact('user', 'faculties', 'specialties', 'groups'));
//        return response()->json([
//            'success' => true,
//            'data' => $user,
//            'faculties' => $faculties,
//            'specialties' => $specialties,
//            'groups' => $groups
//        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:student,teacher,administrator',
            'faculty_number' => 'required_if:role,student',
            'faculty_id' => 'nullable|exists:faculties,id',
            'specialty_id' => 'nullable|exists:specialties,id',
            'semester' => 'nullable|integer|min:1|max:8',
            'group_id' => 'nullable|exists:groups,id',
            'title' => 'required_if:role,teacher'
        ]);
        $user = $this->userService->updateUser($id, $data);
        $user = $this->userService->updateUser($id, $request->all());
        return redirect()->route('uni_users')->with('success', 'Потребителят е обновен успешно.');
//        return response()->json([
//            'success' => true,
//            'message' => 'Потребителят е актуализиран успешно.',
//            'data' => $user
//        ]);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('uni_users')->with('success', 'Потребителят е изтрит успешно.');
//        return response()->json([
//            'success' => true,
//            'message' => 'Потребителят е изтрит успешно.'
//        ]);
    }

     public function editAccount(Request $request)
     {
         return view('student_profile',['user' => $request->user()]);
     }

     public function updateProfile(UpdateProfileRequest $request,UserService $service){

         $service->updateProfile($request->user(),$request->validated());
         return back()->with('success',"Профилът е обновен успешно");

     }
     public function updatePassword(UpdatePasswordRequest $request,UserService $service)
     {
//         Log::info('Туккк съм');
//         Log::debug("Айдеее");
         $service->updatePassword($request->user(),$request->validated());
         try{
             if(!empty($user->email)){
                 Mail::to($user->email)->queue(new PasswordChangedMail($user,now()));
             }
         }catch (\Throwable $e){
             \Log::warning('failed to send PasswordChangedMail',[
                 "user" => $request->user(),
                 'error' => $e->getMessage(),
             ]);
         }
         return back()->with('success','Паролата е сменена успешно');

     }


    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Потребител с този email адрес не съществува.']);
        }

        // Generate a token and store in password_resets table
        $token = Str::random(60);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        // Send email with the token
        Mail::to($request->email)->queue(new PasswordResetMail($token, $user));

        return back()->with('status', 'Изпратихме ви имейл с линк за възстановяване на паролата!');
    }

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given user's password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the password reset record
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Невалиден токен за възстановяване на парола.']);
        }

        // Check if token is expired (e.g., 60 minutes)
        if (now()->diffInMinutes($resetRecord->created_at) > 60) {
            return back()->withErrors(['email' => 'Токенът за възстановяване на парола е изтекъл.']);
        }

        // Update user's password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the used token
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Send notification email
        try {
            if (!empty($user->email)) {
                Mail::to($user->email)->queue(new PasswordChangedMail($user, now()));
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to send PasswordChangedMail', [
                "user" => $user,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('login')->with('status', 'Паролата ви е променена успешно!');
    }

}

