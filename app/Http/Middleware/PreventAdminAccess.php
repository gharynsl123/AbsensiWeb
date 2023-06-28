<?php

namespace App\Http\Middleware;

use Closure;

class PreventAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next) {
        if ($request->user() && $request->user()->level === 'admin') {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }

}
