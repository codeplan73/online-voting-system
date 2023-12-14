<?php

namespace App\Http\Middleware; 

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Prevent caching
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     $response = $next($request);

    //     // Check if the guard is 'student' and if the user is authenticated
    //     if ($guard === 'student' && Auth::guard($guard)->check()) {
    //         // Prevent caching for student guard
    //         $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
    //         $response->headers->set('Pragma', 'no-cache');
    //         $response->headers->set('Expires', '0');
    //     }

    //     return $response;
    // }
}
