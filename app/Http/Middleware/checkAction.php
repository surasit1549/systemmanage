<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;
use App\User;
use App\product_main;
use Auth;
use App\Transform;



class checkAction
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
        
        return $next($request);
    }
}
