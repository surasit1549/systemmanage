<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\log;
Use Illuminate\Support\Facades\Auth;
use App\role;

class UsermanageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkemail(Request $request){
        $user = User::where('email',$request->input('email'))->exists();
        return response()->json(['msg' => $user ]);
    }


    public function index()
    {
        $user = User::all()->toArray();
        return view('usermanage.indexuser',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = role::get();
        return view('usermanage.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);
        User::create($request->toArray());
        unset($request['repassword'], $request['_token']);
        $this->insertlog('CREATE','users',$request->toArray());
        return redirect()->route('usermanage.index')->with('msg','Success !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('usermanage.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $role = role::get();
        return view('usermanage.edit',compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id)
    {
        User::find($id)->update($request->toArray());
        unset($request['token'], $request['_token'], $request['_method'], $request['save']);
        $this->insertlog('UPDATE','users',$request->toArray());
        return redirect()->route('usermanage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function activeUser(Request $request)
    {
        $user = User::find($request->id);
        $input = [
            'username' => $user->username,
            'status' => 'Active'
        ];
        $this->insertlog('UPDATE', 'users', $input);
        $user->update(['status' => 'Active']);
        return redirect()->route('usermanage.index');
     }

    public function destroy($id)
    {
        $user = User::find($id);
        $input = [
            'username' => $user->username,
            'status' => 'Banned'
        ];
        $this->insertlog('UPDATE','users',$input);
        $user->update(['status' => 'banned']);
        return redirect()->route('usermanage.index');
    }

    public function insertlog($action, $table, $data)
    {
        Log::create([
            'username' => Auth::user()->username, 'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
    
}
