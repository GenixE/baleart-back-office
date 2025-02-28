<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!in_array($user->role_id, [1, 2])) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}
