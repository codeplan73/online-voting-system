<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CandidateMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->guard('candidate')->check()) {
            return $next($request);
        }

        return redirect('/candidate-login'); // Redirect unauthorized candi to the login page
    }
} 