<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InactivityMiddleware
{
    public function handle($request, Closure $next)
{
    $timeout = config('session.lifetime') * 10; // tiempo en segundos

    if (!session()->has('lastActivityTime')) {
        session(['lastActivityTime' => now()->timestamp]);
    } elseif (now()->timestamp - session('lastActivityTime') > $timeout) {
        Auth::logout();
        session()->flush();
        return redirect()->route('auth.login')->with('message', 'Has sido desconectado debido a inactividad.');
    }

    session(['lastActivityTime' => now()->timestamp]);
    return $next($request);
}
}

