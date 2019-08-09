<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\Transform;
use App\PR_create;

class pr_createController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pr_create.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pre = prequest::all()->toArray();
        $tran = Transform::all()->toArray();
        return view('pr_create.create', compact('pre', 'tran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lengtharray = sizeof($request->input('name'));

        for ($i = 0; $i < $lengtharray; $i++) {
            $arr = new PR_create([
                'keystore' => $request->input('keystore'),
                'construct_name' => $request->input('construct_name'),
                'typework' => $request->input('typework'),
                'convert' => $request->input('convert')
            ]);
            
            $arr->save();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
