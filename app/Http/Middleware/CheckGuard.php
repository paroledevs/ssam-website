<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'admin':
                    return redirect()->route('admin.login');
                    break;
                case 'shop':
                default:
                    return redirect('/login');
                    break;
            }
        }

        Auth::shouldUse($guard);

        return $next($request);
    }
}
