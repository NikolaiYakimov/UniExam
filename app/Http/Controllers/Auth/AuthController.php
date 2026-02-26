<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function login(AuthRequest $request)
    {
        try {
            $credentials=$request->validated();
            $result = $this->authService->apiLogin($credentials);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ],401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $result = $this->authService->apiLogout($request->user());
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
            $user = $this->authService->getUserWithRelations($request->user());
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to load user data'
            ], 500);
        }
    }

}
