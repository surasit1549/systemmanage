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
        return view('Product_Price.index');
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

    function cat_ID($i){
        $num = $i+1;
        return($num);
    }

    public function store(Request $request)
    {
        $lengtharray = sizeof($request->get('product'));
        $Cat_ID = product_Price::get();
        dd($Cat_ID);
        //dd($request->get('store_name'));
        //if(empty($Cat_ID)){
            for ($i = 0; $i < $lengtharray; $i++){
                $this->cat_ID($i);
                dd($this->cat_ID($i));
                $product_price = new product_Price(
                [
                        'store_name'        => $request->get('store_name'),
                        'Cat_ID'            => '001',
                        'Product_name'      => $request->get('product')[$i],
                        'Price'             => $request->get('Price')[$i],
                        'unit'              => $request->get('unit')[$i]
                ]);
                $product_price->save();
            }
        //}
        for ($i = 0; $i < $lengtharray; $i++){
            $product_price = new product_Price(
            [
                    'store_name'        => $request->get('store_name'),
                    'Cat_ID'            => '001',
                    'Product_name'      => $request->get('product')[$i],
                    'Price'             => $request->get('Price')[$i],
                    'unit'              => $request->get('unit')[$i]
            ]);
            $product_price->save();
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
