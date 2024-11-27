<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lastActivity = session('last_activity'); 
        $currentTime = time(); 

        if ($lastActivity && ($currentTime - $lastActivity) > 1800) {
            Auth::logout();
            session()->invalidate(); 
            session()->regenerateToken(); 
            return redirect()->route('login'); 
        }

        session(['last_activity' => $currentTime]);
        return $next($request);
    }
}
