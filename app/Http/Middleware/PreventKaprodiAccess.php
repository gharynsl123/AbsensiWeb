<?php

namespace App\Http\Middleware;

use Closure;

class PreventKaprodiAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->user() && $request->user()->level === 'kaprodi') {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
