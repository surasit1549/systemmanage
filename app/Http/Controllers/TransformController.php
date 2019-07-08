<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transform;

class TransformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $transform = Transform::all()->toArray();
      return view('transform.index',compact('transform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transform.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      dd('55');
        $this->validate($request,[
                                'convertname'   => 'required',
                                'size'          => 'required']);
        $transform = new Transform(
        [
          'convertname'   => $request->get('convertname'),
          'size'          => $request->get('size')
        ]
      );
      $transform -> save();
      return redirect()->route('transform.index')->with('success','บันทึกข้อมูลเรียบร้อย');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //$transform = Transform::find($id);
      //return view('transform.show');
      //dd($id);
      $transform = Transform::all()->toArray();
      return view('transform.show',compact('transform','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $transform = Transform::find($id);
      return view('transform.edit',compact('transform','id'));
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
      $this->validate($request,
    [
      'convertname'   => 'required',
      'size'          => 'required'
    ]
    );
    $transform = Store::find($id);
    $transform->convertname   = $request->get('convertname');
    $transform->size          = $request->get('size');
    $transform->save();
    return redirect()->route('transform.index')->with('success','successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $transform = Transform::find($id);
      $transform->delete();
      return redirect()->route('transform.index') ->with('success','ลบข้อมูลเรียบร้อย');

    }
}
