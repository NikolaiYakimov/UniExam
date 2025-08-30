<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
//public function login(array $credentials){
//    if(Auth::attempt($credentials)){
//        request()->session()->regenerate();
//        if($req)
////        return $this->redirectByRole(Auth::user()->role);
//    }
//    return back()->withErrors(['username'=>'Грешно потребителско име или парола.']);
//}

    public function redirectByRole(string $role){
        return match($role){
            'administrator' =>redirect()->route('administrator_dashboard'),
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
