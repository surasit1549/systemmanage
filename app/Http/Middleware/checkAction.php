<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;
use App\User;
use App\product_main;
use Auth;
use App\Transform;
use App\permission;



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
        $path = explode('/',$request->path())[0];
        $check = permission::where('role',Auth::user()->role)
                ->where('url',$path)->first();
        if( empty($check) ){
            return redirect('profile');
        }
        return $next($request);
    }
}
