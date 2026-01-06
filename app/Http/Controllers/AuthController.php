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




    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $result = $this->authService->apiLogin($request->only('username', 'password'));
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],  401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = $this->authService->apiLogout($request);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode() ?: 500);
        }
    }

    public function getUserWithRelations(Request $request)
    {
        try {
            $user = $this->authService->getUserWithRelations($request);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load user data'
            ], 500);
        }
    }

}
