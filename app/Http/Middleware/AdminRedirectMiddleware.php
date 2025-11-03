<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        // if(!Auth::guard('admin')->check()) {
        //     return redirect()->route('admin.login');
        // }
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard == 'admin') {
                    return redirect()->route('admin.dashboard');
                }elseif ($guard == 'web') {
                    return redirect()->route('user.dashboard');
                }
                 else {
                    return redirect()->route('home');
                }
            }
        }
        return $next($request);
    }
}
