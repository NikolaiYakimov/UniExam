<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
public function login(array $credentials){
    if(Auth::attempt($credentials)){
        request()->session()->regenerate();
        return $this->redirectByRole(Auth::user()->role);
    }
    return back()->withErrors(['username'=>'Грешно потребителско име или парола.']);
}

    private function redirectByRole(string $role){
        return match($role){
            'administrator' =>redirect()->route('admin.subjects.uni_subjects'),
            'teacher' => redirect()->route('teacher_dashboard'),
            'student' => redirect()->route('exams'),
            default => redirect()->route('login'),
        };
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect('/login');
    }
}
