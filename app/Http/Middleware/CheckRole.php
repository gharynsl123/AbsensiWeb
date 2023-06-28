<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $allowedRoles = ['admin' ,'guru', 'kaprodi', 'siswa'];

        if ($request->user() && in_array($role, $allowedRoles)) {
            if ($request->user()->level === $role) {
                return $next($request);
            }
        }
    
        abort(403, 'Unauthorized.');
    }
}
