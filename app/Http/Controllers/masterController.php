<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class masterController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
