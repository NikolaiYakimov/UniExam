<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
//        return $this->authService->login($request->validated());
        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if($request->expectsJson()){
                return response()->json([
                    'redirect'=>$this->authService->redirectByRole(Auth::user()->role),
                ]);
            }
        }
    }

    public function logout(Request $request):\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        return $this->authService->logout($request);
    }
}
