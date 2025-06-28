<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.home');
            } elseif (Auth::user()->hasRole('berwenang')) {
                return redirect()->route('berwenang.home');
            } else {
                 return redirect()->route('profile');
            }
        }

        return $next($request);
    }
}

