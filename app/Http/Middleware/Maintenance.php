<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Redirect;
use Closure;
use Route;

class Maintenance
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
        if (config('app.maintenance') && (Route::current()->getName() !== 'maintenance')) {
            return redirect('/maintenance');
        } elseif (!config('app.maintenance') && (Route::current()->getName() == 'maintenance')) {
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
