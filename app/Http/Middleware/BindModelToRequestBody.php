<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class BindModelToRequestBody
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $accessor, $property = null)
    {
        $class = '\App\Models\\'.Str::ucfirst($accessor);

        throw_unless(class_exists($class), ModelNotFoundException::class, "Fail trying to bind: $class".'[Class not found]');

        if ($accessor) {
            $modelId = optional($request)->{$property ?? $accessor};

            $result = call_user_func($class.'::find', $modelId);

            if (filled($result)) {
                $request->merge([$accessor => $result]);
            }
        }

        return $next($request);
    }
}
