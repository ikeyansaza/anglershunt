<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin_roles = explode(',', env('ADMIN_ROLES'));

        if (!in_array(auth()->user()->email, $admin_roles)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
