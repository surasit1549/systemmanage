<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkpasscodeController extends Controller
{
    public function checkcode(Request $request){
        if( Auth::user()->passcode == $request->passkey ){
            return response()->json(['msg' => true]);
        }
        return response()->json(['msg' => false]);
    }
}
