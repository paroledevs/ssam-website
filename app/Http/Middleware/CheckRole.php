<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $hasSomeRole = false;

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                $hasSomeRole = true;
            }
        }

        if (! $hasSomeRole) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
