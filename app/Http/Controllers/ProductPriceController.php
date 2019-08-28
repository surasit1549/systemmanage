<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\product_main;
use App\product_Price;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number = 1;
        $product_price = product_Price::Join('product_mains','product__Prices.Product','=','product_mains.Product_ID')->get()->toArray();
       // dd($product_price);
    //    dd($product_price[0]['Product']);
        return view('Product_Price.index',compact('product_price','number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::all()->toArray();
        $product = product_main::get()->toArray();
        $unit = product_main::select('unit')->distinct()->get();
        //dd($product);
        return view('Product_Price.create',compact('store','product','unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function cat_ID_New($i){
        $number = $i+1;
        if ($number < 10) {
            $key_num = strval($number);
            $key = "000$key_num";
        } elseif ($number < 100) {
            $key_num = strval($number);
            $key = "00$key_num";
        } elseif ($number < 1000){
            $key_num = strval($number);
            $key = "0$key_num";
        } else {
            $key_num = strval($number);
            $key = "$key_num";
        }
        return($key);
    }

    function cat_ID($id){
        foreach($id as $row){
            $id_cat = $row['Cat_ID'];
        }
        $id_cats = substr($id_cat,9);
        $num = $id_cats+1;
        if ($num < 10) {
            $key_num = strval($num);
            $key = "000$key_num";
        } elseif ($num < 100) {
            $key_num = strval($num);
            $key = "00$key_num";
        } elseif ($num < 1000){
            $key_num = strval($num);
            $key = "0$key_num";
        } else {
            $key_num = strval($num);
            $key = "$key_num";
        }
        return($key);
    }

    function Cats_id($product_id){
        $after_catid = Product_Price::where('Product',$product_id[0])->addSelect('CatID')->get()->toArray();
        if(empty($after_catid)){
            $key = $product_id[0]['Product_ID'];
        }else{
            $key = $after_catid[0]['CatID'];
        }
        return $key;
    }

    public function store(Request $request)
    {
        $lengtharray = sizeof($request->get('product'));
        $Cat_ID = product_Price::get()->toArray();
        $store_id = store::where('name',$request->get('store_name'))->addSelect('keystore')->get()->toArray();
        if(empty($Cat_ID)){
            for ($i = 0; $i < $lengtharray; $i++){
                $product_id = product_main::where('Product_name',$request->get('Product_name')[$i])->addSelect('Product_ID')->get();
                $ID = $this->cat_ID_New($i);
                $CatID = $ID;
                //dd($ID,$CatID);
                $product_id = product_main::where('Product_name',$request->get('product')[$i])->addSelect('Product_ID')->get()->toArray();
                $Cat_ID = $store_id[0]['keystore'].'-'.$product_id[0]['Product_ID'].'-'.$ID;
                $product_price = new product_Price(
                [
                        'Cat_ID'            => $Cat_ID,
                        'CatID'             => $CatID,
                        'Store'             => $store_id[0]['keystore'],
                        'Product'           => $product_id[0]['Product_ID'],
                        'Price'             => $request->get('Price')[$i]
                ]);
                $product_price->save();

            }
        }else{
            for ($i = 0; $i < $lengtharray; $i++){
                $id = product_Price::get('Cat_ID')->toArray();
                $product_id = product_main::where('Product_name',$request->get('product')[$i])->addSelect('Product_ID')->get()->toArray();
                
                $catid = product_Price::get()->toArray();
                //dd($catid);
                $ID = $this->cat_ID($id);
                $CatID = $this->Cats_id($product_id);
                //dd($CatID);
                $cat = $store_id[0]['keystore'].'-'.$product_id[0]['Product_ID'].'-'.$ID;
                //dd($product_id[0]['Product_ID']);
                //dd($cat);
                $product_price = new product_Price(
                [
                        'Cat_ID'            => $cat,
                        'CatID'             => $CatID,
                        'Store'             => $store_id[0]['keystore'],
                        'Product'           => $product_id[0]['Product_ID'],
                        'Price'             => $request->get('Price')[$i]
                ]);
                $product_price->save();
                
            }
        }
        return redirect()->route('Product_Price.index')->with('success','เพิ่มข้อมูลเรียบร้อยแล้ว');
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
        //
    }
}
