<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\PasswordChangedMail;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
     public function edit(Request $request)
     {
         return view('profile',['user' => $request->user()]);
     }

     public function updateProfile(UpdateProfileRequest $request,UserService $service){
         Log::info('aaaaa');
         Log::debug("abbbb");
         $service->updateProfile($request->user(),$request->validated());
         return back()->with('success',"Профилът е обновен успешно");

     }
     public function updatePassword(UpdatePasswordRequest $request,UserService $service)
     {
         Log::info('Туккк съм');
         Log::debug("Айдеее");
         $service->updatePassword($request->user(),$request->validated());
         try{
             if(!empty($user->email)){
                 Mail::to($user->email)->queue(new PasswordChangedMail($user,now()));
             }
         }catch (\Throwable $e){
             \Log::warning('failed to send PasswordChangedMail',[
                 "user" => $request->user(),
                 'error' => $e->getMessage(),
             ]);
         }
         return back()->with('success','Паролата е сменена успешно');

     }
}
