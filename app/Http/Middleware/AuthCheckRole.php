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
//    public function handle(Request $request, Closure $next, string $role): Response
//    {
//
//        //If the user is not logged in
//        if(!auth()->check()){
//            return redirect()->route('login');
//        }
//
//        $user = auth()->user();
//        if (!$user || $user->role !== $role) {
//            abort(403,'Нямате достъп до тази страница  ');
//        }
//
//        return $next($request);
//    }
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // If the user is not logged in
        if(!auth()->check()){
            // For API requests, return JSON response
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Не сте влезли в системата'], 401);
            }
            return redirect()->route('login');
        }

        $user = auth()->user();
        if (!$user || $user->role !== $role) {
            // For API requests, return JSON response
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Нямате достъп до този ресурс'], 403);
            }
            abort(403, 'Нямате достъп до тази страница');
        }

        return $next($request);
    }
}
