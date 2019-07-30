<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\prequestconvert;
use App\store;
use App\prequeststore;
use App\prequestdb;
use App\product;
use App\productdb;
use App\prequestproduct;
use App\number;
use App\porderdb;
use App\porder;

class PuchaserequestController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $number=1;
    $prequestdb = prequest::all()->toArray();
    return view('prequest.index', compact('prequestdb', 'number'));
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
      $productdb = new Product([
        'keyPR'           => $request->input('keyPR'),
        'formwork'        => $request->input('formwork'),
        'date'            => $request->input('date'),
        'productname'     => $request->input('name')[$i],
        'productnumber'   => $request->input('num')[$i],
        'unit'            => $request->input('units')[$i],
        'keystore'        => $request->input('store')[$i],
        'price'           => $request->input('price')[$i],
        'sum'             => $request->input('sum')[$i],
      ]);

      $porderdb = new porder([
        'keyPR'           => $request->input('keyPR'),
        'date'            => $request->input('date'),
        'keystore'        => $request->input('store')[$i],
      ]);

      $productdb->save();
      $porderdb->save();
    }
    $prequestdb = new prequest([
      'keyPR'           => $request->input('keyPR'),
      'date'            => $request->input('date'),
      'contractor'      => $request->input('contractor'),
      'formwork'        => $request->input('formwork'),
      'prequestconvert' => $request->input('prequestconvert'),

    ]);

    $prequestdb->save();
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
    $number=1;
    $prequeststore = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    $prequestdb = prequest::find($id);
    $productdb = product::find($id);
    //dd($productdb->keyPR);
    $prequestproduct = product::all()->toArray();
    //dd($prequestproduct);
    return view('prequest.show', compact('prequestdb', 'prequeststore', 'prequestconvert', 'prequestproduct', 'id', 'number'));
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
    $number=1;
    $prequestdb = prequest::find($id);
    $productdb = product::find($id);
    //dd($productdb->keyPR);
    $prequestproduct = product::all()->toArray();
    //dd($prequestproduct);
    return view('prequest.edit', compact('prequestdb', 'prequeststore', 'prequestconvert', 'prequestproduct', 'id', 'number'));
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
    //
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
