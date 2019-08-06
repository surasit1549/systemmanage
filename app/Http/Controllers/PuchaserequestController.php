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
    $stores = store::all()->toArray();
    return view('prequest.create', compact('prequeststore', 'prequestconvert' ,'stores'));
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
        'productname'     => $request->input('name')[$i],
        'productnumber'   => $request->input('num')[$i],
        'unit'            => $request->input('units')[$i],
        'keystore'        => $request->input('store')[$i],
        'price'           => $request->input('price')[$i],
        'sum'             => $request->input('sum')[$i],
      ]);
      $productdb->save();

      $porderdb = new porder([
        'keyPR'           => $request->input('keyPR'),
        'date'            => $request->input('date'),
        'keystore'        => $request->input('store')[$i],
        'contractor'      => $request->input('contractor'),
        'formwork'        => $request->input('formwork'),
        'prequestconvert' => $request->input('prequestconvert'),
      ]);
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
    return response()->json(['message' => 'success'],200);
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
    
    return view('prequest.show', compact(
                                          'prequestdb', 
                                          'prequeststore', 
                                          'prequestconvert', 
                                          'prequestproduct', 
                                          'id', 
                                          'number'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $stores = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    $number=1;
    $prequestdb = prequest::find($id);
    $productdb = product::find($id);
    $pr_db = prequest::all()->toArray();
    $prequestproduct = product::all()->toArray();
    $num_pr = sizeof($prequestproduct);
    $num_id = intval($id);
    foreach($prequestproduct as $row){
      $pr_product1[] = [
                      $row['keyPR'],
                      $row['formwork'],
                      $row['productname'],
                      $row['productnumber'],
                      $row['unit'],
                      $row['keystore'],
                      $row['price'],
                      $row['sum']
      ];
      $pr_product2[] = [
                      $row['keyPR']
      ];
    }
    foreach($pr_db as $row){
      $pr[] = [
                $row['keyPR']
      ];
    }
    //dd($pr_product2);
    for($i=0; $i<$num_pr; $i++){
      if($pr[$num_id] === $pr_product2[$i]){
        $pr_products[] = $pr_product1[$i];
      }
    }
    dd($num_id);
    //dd($pr_products);
    return view('prequest.edit', compact(
                                        'prequestdb', 
                                        'stores', 
                                        'prequestconvert', 
                                        'id',
                                        'pr_products',
                                        'number'
    ));
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
