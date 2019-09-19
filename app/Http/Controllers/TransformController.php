<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transform;
use Auth;
use App\log;

use function Opis\Closure\serialize;

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
    $this->insertlog('CREATE','transforms',$input);
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

    $input = [
      'convertname' => $request->convertname,
      'size' => $request->size
    ];

    $this->insertlog('UPDATE', 'transforms', $input);

    $transform = Transform::find($id)->update($input);


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
    $input = [
      'convertname' => $transform->convertname
    ];
    $this->insertlog('DELETE', 'transforms', $input);
    $transform->delete();
    return redirect()->route('transform.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
  }

  public function insertlog($action, $table, $data)
  {
    Log::create([
      'username' => Auth::user()->username, 'data' => serialize($data), 'table' => $table, 'action' => $action
    ]);
  }
}
