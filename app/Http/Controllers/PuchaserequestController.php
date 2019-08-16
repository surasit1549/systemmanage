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
use vendor\autoload;

use App\Create_product;
use App\PR_create;

class PuchaserequestController extends Controller
{

  public function filetopdf(Request $request){
    
    $mpdf = new \Mpdf\Mpdf(['default_font_size' => 16,'default_font' => 'thsarabunnew']);
    $mpdf->WriteHTML($request->get('html'));
    $mpdf->Output(); 

  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $number = 1;
    $num = 1;
    $pr_create = pr_create::all()->toArray();

    if(empty($pr_create)){
      $pr_create;
      $PR_create = '';
      //dd($PR_create);
    }else{
      //dd('555s');
      foreach($pr_create as $row){
        $PR_create[] = [
                          $num_id = $num++,
                          $row['key'],
                          $row['date'],
                          $row['contractor'],
                          $row['formwork'],
                          $row['prequestconvert']
        ];
      }  
    }
    $pr_num = sizeof($pr_create);
    for($i=$pr_num-1; $i>=0; $i--){
        $PR_creates[] = $PR_create[$i];
    }
    //dd($prequest);
    //dd($pr_prequest[2][0]);
    return view('prequest.index', compact(
                                          'number',
                                          'PR_creates',
                                          'pr_create'
    ));
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
    return view('prequest.create', compact(
                                            'prequeststore', 
                                            'prequestconvert',
                                            'stores'
                                          ));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    return response()->json(['message' => 'success']);
    $lengtharray = sizeof($request->input('name'));

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
          'sumofprice'      => $request->input('sumofprice')
          
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
    //$stores = store::all()->toArray();
    $prequeststore = store::all()->toArray();
    $prequestconvert = transform::all()->toArray();
    $prequestdb = prequest::find($id);
    $productdb = product::find($id);
    $pr_db = prequest::all()->toArray();
    $prequestproduct = product::all()->toArray();

    $num_pr = sizeof($pr_db);
    $num_product = sizeof($prequestproduct);
    $num_id = intval($id);
    //dd($num_id);
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
    //dd($pr_product1);
    foreach($pr_db as $row){
      $pr1[] = [
                $row['keyPR'],
                $row['date'],
                $row['contractor'],
                $row['formwork'],
                $row['prequestconvert'],
                $row['sumofprice']
      ];
    }

    for($j=0; $j<$num_pr; $j++){
      if($pr1[$num_id-1][0] === $pr1[$j][0]){
        $pr_prequest = $pr1[$j];
      }
    }
    for($i=0; $i<$num_product; $i++){
      if($pr1[$num_id-1][0] === $pr_product2[$i][0]){
        $pr_products[] = $pr_product1[$i];
      }
    }
    //dd($stores);
    return view('prequest.show', compact(
                                          'number',
                                          'id',
                                          'pr_products',
                                          'pr_prequest'

    ));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $number = 1;
    //dd($id);
    $pr_product = Create_product::all()->toArray();
    $pr_create = PR_create::find($id);
    $prequestdb = prequest::find($id);
    $prequestconvert = transform::all()->toArray(); 
    $stores = store::all()->toArray();
    $pr_products = Create_product::where('key','=',$pr_create['key'])->get();
    //dd($pr_create['date']);
    return view('prequest.create', compact(
                                          'pr_create',
                                          'pr_products',
                                          'number',
                                          'prequestconvert',
                                          'stores',
                                          'prequestdb',
                                          'id'));
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