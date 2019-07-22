<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\prequestconvert;
use App\store;
use App\prequeststore;
use App\prequestdb;

class PuchaserequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $prequestdb = prequest::all()->toArray();
    return view('prequest.index', compact('prequestdb'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $prequeststore = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    //  dd(gettype('$prequeststore'));
    //  return $prequest;
    //  return $prequeststore;
    //  return view('prequest.create',compact('prequest'));
    return view('prequest.create', compact('prequeststore', 'prequestconvert'));
    //  return view('prequest.create')->with('prequest');
    //  return view('prequest.create');
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
    /*     $this->validate($request, [
      'keyPR'           => 'required',      // หมายเลขใบPR
      'date'            => 'required',      // วันเดือนปี PR
      'contractor'      => 'required',      // ชื่อผู้รับเหมา
      'formwork'        => 'required',      // รูปแบบงาน
      'prequestconvert' => 'required',      // แปลง
    ]); */


    for ($i = 0; $i < $lengtharray; $i++) {
      $่prequestdb = new prequest([
        'keyPR'           => $request->input('keyPR'),
        'date'            => $request->input('date'),
        'contractor'      => $request->input('contractor'),
        'formwork'        => $request->input('formwork'),
        'prequestconvert' => $request->input('prequestconvert'),
        'productname'     => $request->input('name')[$i],
        'productnumber'   => $request->input('num')[$i],
        'unit'            => $request->input('units')[$i],
        'keystore'        => $request->input('store')[$i],
        'price'           => $request->input('price')[$i],
        'sum'             => $request->input('sum')[$i],
      ]);

      $่prequestdb->save();
    }

    return response()->json(["message" => 'Success'], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $prequeststore = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    $prequestdb = prequest::find($id);
    return view('prequest.show', compact('prequestdb', 'prequeststore', 'prequestconvert', 'id'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $prequeststore = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    $prequestdb = prequest::find($id);
    return view('prequest.edit', compact('prequestdb', 'prequeststore', 'prequestconvert', 'id'));
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
    dd('44');
    $this->validate(
      $request,
      [
        'keyPR'           => 'required',
        'date'            => 'required',
        'contractor'      => 'required',
        'formwork'        => 'required',
        'prequestconvert' => 'required',
        'productname'     => 'required',
        'productnumber'   => 'required',
        'unit'            => 'required',
        'keystore'        => 'required',
        'price'           => 'required',
        'sum'             => 'required',
      ]
    );
    //dd('22');
    $prequestdb = prequest::find($id);
    $prequestdb->keyPR            = $request->get('keyPR');
    $prequestdb->date             = $request->get('date');
    $prequestdb->contractor       = $request->get('contractor');
    $prequestdb->formwork         = $request->get('formwork');
    $prequestdb->prequestconvert  = $request->get('prequestconvert');
    $prequestdb->productname      = $request->get('productname');
    $prequestdb->productnumber    = $request->get('productnumber');
    $prequestdb->unit             = $request->get('unit');
    $prequestdb->keystore         = $request->get('keystore');
    $prequestdb->price            = $request->get('price');
    $prequestdb->sum              = $request->get('sum');
    $prequestdb->save();
    return redirect()->route('prequest.index')->with('success', 'successfully updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $prequestdb = prequest::find($id);
    $prequestdb->delete();
    return redirect()->route('prequest.index')->with('success', 'ลบข้อมูลเรียบร้อย');
  }
}
