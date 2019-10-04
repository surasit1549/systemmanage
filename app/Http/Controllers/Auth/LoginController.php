<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected function redirectTo()
    {
        if( Auth::user()->role == 1 ){
            return '/pr_create';
        }else if( Auth::user()->role == 2 ){
            return '/prequest';
        }else if( Auth::user()->role == 3 ){
            return '/Authorized_person1';
        }else if(Auth::user()->role == 4 ){
            return '/Authorized_person2';
        }else if(Auth::user()->role == 5 ){
            return '/usermanage';
        }
    }

    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
