<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Closure;

class HttpsProtocol
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
        if (env('APP_ENV') === 'local') {
            return $next($request);
        } else {
            if (config('app.force2www')) {
                if (!$request->secure() && env('APP_ENV') === 'prod') {
                    if(preg_match('/www/', $_SERVER['HTTP_HOST']))
                    {
                        return redirect()->secure($request->getRequestUri());
                    } else {
                        return Redirect::to('https://www.'.$_SERVER['HTTP_HOST'].$request->getRequestUri());
                    }
                } else {
                    if(preg_match('/www/', $_SERVER['HTTP_HOST']))
                    {
                        return $next($request);
                    } else {
                        return Redirect::to('https://www.'.$_SERVER['HTTP_HOST'].$request->getRequestUri());
                    }
                }
            } else {
                if (!$request->secure()) {
                    return redirect()->secure($request->getRequestUri());
                } else {
                    return $next($request);
                }
            }           
            
        }
    }
}
