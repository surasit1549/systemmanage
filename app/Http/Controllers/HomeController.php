<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = auth()->user();
        dd($auth);
        return view('Home');
/*         if( $auth->hasRole('constractor') ){
            return view('pr_create.index');
        }else if( $auth->hasRole('purchasing') ){
            return view('Product_Price.index');
        }else if( $auth->hasRole('master1') ){
            return view('store.index');
        }else if( $auth->hasRole('master2') ){
            return view('store.index');
        }else{
            return view('store.index');
        } */
    }
}
