<?php

namespace App\Http\Middleware;

use Closure;

class createToken
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

        $SY = newSession();

        $session_name = 's_token';

        $token = $request->get($session_name) ?: $request->header($session_name);

        if(!$token || !$SY->findToken($token)){
            $token = $SY->createSession();

            header("Access-Control-Expose-Headers: $session_name");
            header("$session_name: $token");

        }else $SY->findSession();

        // $SY->addLog();

        return $next($request);
    }
}
