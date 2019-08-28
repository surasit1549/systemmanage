<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\store;
use App\product;
use vendor\autoload;

use App\Create_product;
use App\PR_create;
use App\product_Price;
use App\product_main;
use App\pr_store;

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
                          $row['id'],
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
    return view('prequest.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
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
    $db = Create_product::get()->toArray();
    //dd($db[0]['key']);
    $pr_create = PR_create::find($id)->toArray();
    $productdb = Create_product::where('key',$pr_create['key'])->get()->toArray();
    //dd($productdb);
    return view('prequest.show', compact(
                                          'number',
                                          'id',
                                          'productdb',
                                          'pr_create'

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
    $sum = 0;
    $pr_create = PR_create::find($id)->toArray();
    //dd($pr_create['key']);
    $productdb = Create_product::where('key',$pr_create['key'])->get('productname')->toArray();
    $lengtharray = sizeof($productdb);
    for($i=0; $i<$lengtharray; $i++){
      $product_id = product_main::where('product_name',$productdb[$i])->get()->toArray();
      $product_price = product_Price::where('Product',$product_id)->min('Price');
                                    //  ->where('Product',$product_id[0]['Product_ID'])->min('Price');
      $product_min_price[] = product_main::where('product_name',$productdb[$i])
                                       ->join('product__Prices','product_mains.Product_ID','product__Prices.Product')
                                       ->where('Price',$product_price)
                                       ->get()->toArray();
      $product_number = Create_product::where('key',$pr_create['key'])->get()->toArray();      
      //dd($product_min_price[0][0]);   
      $products_sum = [$product_price*$product_number[$i]['productnumber']];
      $sum = [$sum[0]+$products_sum[0]];
      $min[] = [
                $product_min_price[$i][0]['Product_ID'],
                $product_number[$i]['productnumber'],
                $product_min_price[$i][0]['unit'],
                $product_min_price[$i][0]['Store'],
                $product_min_price[$i][0]['Price'],
                $products_sum[0],
                ];  
    }
    //dd($min);
    return view('prequest.edit', compact(
                                          'number',
                                          'pr_create',
                                          'min',
                                          'sum',
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
    dd(55);
    $lengtharray = sizeof($request->get('Product_name'));
    for($i=0; $i<$lengtharray; $i++){
      $pr_store = new pr_store([
                'keyPR'         =>$request->get('keyPR'),
                'Product_name'  =>$request->get('Product_name')[$i],
                'Product_number'=>$request->get('Product_number')[$i],
                'unit'          =>$request->get('unit')[$i],
                'keystore'      =>$request->get('keystore')[$i],
                'price'         =>$request->get('price')[$i],
                'product_sum'   =>$request->get('product_sum')[$i]
      ]);
      $pr_store->save();
    }
    $prequest = new prequest([
                'keyPR'             =>$request->get('keyPR'),
                'date'              =>$request->get('date'),
                'formwork'          =>$request->get('formwork'),
                'prequestconvert'   =>$request->get('prequestconvert'),
                'sumofprice'        =>$request->get('sum'),
    ]);
    $prequest->save();
    return redirect()->route('prequest.index')->with('success','เรียบร้อยแล้ว');
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