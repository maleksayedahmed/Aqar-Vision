<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAgency
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated AND has an associated agency profile
        if (Auth::check() && Auth::user()->agency) {
            return $next($request);
        }

        // If not, abort with a 403 Forbidden error
        abort(403, 'Unauthorized Access');
    }
}