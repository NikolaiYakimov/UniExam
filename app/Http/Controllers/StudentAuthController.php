<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthController extends Controller
{
    public function showLoginForm(){
        return view('student_login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if(Auth::guard('student')->attempt($credentials)){
            $request->session()->regenerate();
//            return view('exams');
            return redirect()->route('exams');
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
