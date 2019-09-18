<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transform;
use Auth;
use App\log;

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
    return view('transform.index', compact('transform'));
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

    $this->validate($request, [
      'convertname'   => 'required',
      'size'          => 'required'
    ]);
    $input =       [
      'convertname'   => $request->get('convertname'),
      'size'          => $request->get('size')
    ];

    $transform = new Transform($input);

    $data = '(' . implode(',', array_keys($input)) . ') => (' . implode(',', $input) . ')';
    $table = 'transforms';
    $action = 'CREATE';
    log::create(['username' => Auth::user()->username, 'data' => $data, 'table' => $table, 'action' => $action]);

    $transform->save();



    return redirect()->route('transform.index')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  { }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //dd('22');
    $transform = Transform::find($id);
    return view('transform.edit', compact('transform', 'id'));
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
    $this->validate(
      $request,
      [
        'convertname'   => 'required',
        'size'          => 'required'
      ]
    );

    $data = array();
    $old = array();
    $detailTable = Transform::find($id)->get();
    if ($detailTable[0]->convertname != $request->convertname) {
      $data += ['convertname' => $request->convertname];
      $old += ['0' => $detailTable[0]->convertname];
    }
    if ($detailTable[0]->size != $request->size) {
      $data += ['size' => $request->size];
      $old += ['1' => $detailTable[0]->size];
    }
    Log::create([
      'table' => 'transforms', 'action' => 'UPDATE', 'username' => Auth::user()->username, 'data' => '(' . implode(',', array_keys($data)) . ') => OLD (' . implode(',', $old) . ') => NEW (' . implode(',', $data) . ')'
    ]);

    $transform = Transform::find($id);
    $transform->convertname   = $request->get('convertname');
    $transform->size          = $request->get('size');
    $transform->save();


    return redirect()->route('transform.index')->with('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
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
    $table = 'transforms';
    $action = 'DELETE';
    $data = 'convertname = ' . (clone $transform)->get('convertname')[0]->convertname;
    log::create(['username' => Auth::user()->username, 'data' => $data, 'table' => $table, 'action' => $action]);
    $transform->delete();
    return redirect()->route('transform.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
  }
}
