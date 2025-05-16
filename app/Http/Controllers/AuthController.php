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

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
           $user = Auth::user();
//            return match ($user->role) {

            return match ($user->role){
                'administrator' => redirect()->route('administrator_dashboard'),
                'teacher' => redirect()->route('teacher_dashboard'),
                'student' => redirect()->route('exams'),
                default => redirect()->route('login'),
            };

        }

        return back()->withErrors([
            'username' => 'Грешно потребителско име или парола.',
        ]);
    }

    public function logout(Request $request):\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
