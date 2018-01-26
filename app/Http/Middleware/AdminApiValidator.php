<?php

namespace App\Http\Middleware;

use Closure;

class AdminApiValidator
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

        if(!$user = nowUser())
            return err('Please Login.');


        return $user->is_admin() ? $next($request) : err('permission denied');

    }
}
