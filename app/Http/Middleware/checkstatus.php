<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkstatus
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
        if( Auth::user()->status == 'banned' ){
            Auth::logout();
            return redirect('login');
        }
        return $next($request);
    }
}
