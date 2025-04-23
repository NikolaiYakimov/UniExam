<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm():View{
        return view('user_login');
    }

    public function login(Request $request):object{
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::guard('student')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('exams');
        }

        if(Auth::guard('teacher')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('teacher_dashboard');
        }
        echo "Error";
        return back()->withErrors([
            'username' => 'Грешно потребителско име или парола.',
        ]);
    }
    public function logout(Request $request):\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        return redirect('/login');
    }
}
