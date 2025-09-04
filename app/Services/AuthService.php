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

    public function redirectByRole(string $role)
    {
        // Return the target route URL instead of a RedirectResponse so
        // that callers can handle the navigation (e.g. in React) without
        // receiving a serialized redirect object.
        return match ($role) {
            'administrator' => route('admin.dashboard', [], false),
            'teacher'       => route('teacher_dashboard', [], false),
            'student'       => route('exams', [], false),
            default         => route('login', [], false),
        };
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
         return redirect('/login');
    }
}
