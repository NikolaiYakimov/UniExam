<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        //If the user is not logged in
        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(auth()->user()->role !== $role){
            abort(403,'Нямате достъп до тази страница  ');
        }

        return $next($request);
    }
}
