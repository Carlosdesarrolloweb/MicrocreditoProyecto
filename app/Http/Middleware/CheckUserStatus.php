<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Auth\RequestGuard;


class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->estado_usuario === 'inactivo') {
            Auth::logout();
            return redirect('/')->with('status', 'Tu cuenta ha sido desactivada.');
        }
        return $next($request);
    }
}
