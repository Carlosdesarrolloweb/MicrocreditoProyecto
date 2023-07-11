 <?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->estado_usuario === 'INACTIVO') {
            Auth::logout();
            return redirect('/')->with('status', 'Tu cuenta ha sido desactivada.');
        }
        return $next($request);
    }
}

