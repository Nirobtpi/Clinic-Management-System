<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LoginCacheMiddelware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $cacheKey = 'auth_user_id_' . $user->id;

            // Check if cache exists (user session is active)
            if (!Cache::has($cacheKey)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('user.login')
                    ->with('message', 'Session expired, please login again.');
            }
        }

        return $next($request);
    }
}
