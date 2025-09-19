<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
    public function showLoginForm():View{
        return view('user_login');
    }

    public function login(LoginRequest $request){
        return $this->authService->login($request->validated());
    }

    public function logout(Request $request):\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        return $this->authService->logout($request);
    }

// ... други методи
//
//    public function apiLogin(Request $request)
//    {
//        $request->validate([
//            'username' => 'required',
//            'password' => 'required',
//        ]);
//
//        $user = User::where('username', $request->username)->first();
//
//        if (!$user || !Hash::check($request->password, $user->password)) {
//            throw ValidationException::withMessages([
//                'username' => ['Грешно потребителско име или парола.'],
//            ]);
//        }
//
//        $token = $user->createToken('api-token')->plainTextToken;
//
//        return response()->json([
//            'token' => $token,
//            'user' => $user,
//            'redirect' => $this->apiRedirectByRole($user->role)->getTargetUrl()
//        ]);
//    }
//
//    public function apiLogout(Request $request)
//    {
//        $request->user()->currentAccessToken()->delete();
//
//        return response()->json(['message' => 'Успешно излязохте от системата.']);
//    }
//
//// Помощен метод за API
    private function apiRedirectByRole(string $role)
    {
        $routes = [
            'administrator' => '/admin/dashboard',
            'teacher' => '/teacher/dashboard',
            'student' => '/student/exams',
        ];

        return $routes[$role] ?? '/login';
    }

    public function apiLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Грешно потребителско име или парола.'
            ], 401);
        }

        $user->tokens()->delete();

        switch ($user->role) {
            case 'student':
                $user->load(['student.faculty', 'student.specialty', 'student.group']);
                break;
            case 'teacher':
                $user->load(['teacher.faculty', 'teacher.specialty']);
                break;
            case 'administrator':
                $user->load('administrator');
                break;
        }
        $token = $user->createToken('api-token')->plainTextToken;
//        Log::info('-----------------------');
//        Log::info($token);
//        Log::info($user);
        return response()->json([
            'token' => $token,
            'user' => $user,
            'redirect' => $this->apiRedirectByRole($user->role)
        ]);
    }

//    private function apiRedirectByRole(string $role)
//    {
//        $routes = [
//            'administrator' => '/admin/dashboard',
//            'teacher' => '/teacher/dashboard',
//            'student' => '/student/exams',
//        ];
//
//        return $routes[$role] ?? '/login';
//    }
    public function apiLogout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            Log::debug("Напуснах системата");

            return response()->json(['message' => 'Успешно излязохте от системата.']);

        }catch (\Exception $exception){
            return response()->json(['message' => 'Logout failed'], 500);
        }
    }

    public function getUserWithRelations(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $request->user();

        // Load relationships based on role
        switch ($user->role) {
            case 'student':
                $user->load(['student.faculty', 'student.specialty', 'student.group']);
                break;
            case 'teacher':
                $user->load(['teacher.faculty', 'teacher.specialty', 'teacher.exams' => function($query) {
//                    $query->where('status', 'active');
                }]);
                break;
            case 'administrator':
                $user->load('administrator');
                break;
        }

        return response()->json($user);
    }
}
