<?php

namespace App\Http\Middleware;

use Closure;


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

        $method = explode('\\',$request->route()->getActionName());
        $action = $method[count($method)-1];
        if( $action == 'storeController@update' ){

        }else if( $action == 'storeController@store' ){

        }else if( $action == 'storeController@update' ){

        }else if( $action == 'storeController@destroy' ){

        }else if( $action == 'ProductController@store' ){

        }else if($action == 'ProductController@update'){

        }else if($action == 'ProductController@destroy'){

        }else if($action == 'ProductPriceController@store'){

        }else if($action == 'ProductPriceController@update'){

        }else if($action == 'ProductPriceController@destroy'){

        }else if($action == 'pr_createController@store' ){

        }else if ($action == 'pr_createController@update'){

        }else if ($action == 'pr_createController@destroy'){

        }else if ($action == 'PuchaserequestController@store'){

        }else if ($action == 'PuchaserequestController@update'){

        }else if ($action == 'PuchaserequestController@destroy'){

        }else if( $action == 'PurchaseorderController@store' ){
            
        }else if( $action == 'usermanageController@store' ){

        }else if( $action == 'usermanageController@update' ){
            
        }else if($action == 'usermanageController@destroy'  ){

        }else if( $action == 'profileController@update' ){

        }
        //dd($request->route()->getActionName());
        //dd($request->convertname);
        return $next($request);
    }
}
