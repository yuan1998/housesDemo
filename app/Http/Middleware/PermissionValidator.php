<?php

namespace App\Http\Middleware;

use Closure;


class PermissionValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type)
    {

        $url = $request->url();
        // dd($url);
        if(!$user = nowUser())
            return err('Please Login.');

        $action = "is_$type";

        if(!$user->$action())
            return err('permission defined');

        return $next($request);
    }
}
