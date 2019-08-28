<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\PR_create;
use App\Create_product;
use App\product_main;
use App\product_Price;

class Person1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = prequest::get()->toArray();
        return view('Authorized_person1.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
          $product_name = product_main::where('Product_ID',$product_min_price[$i][0]['Product_ID'])->get()->toArray();
          $min[] = [
                    $product_name[0]['Product_name'],
                    $product_number[$i]['productnumber'],
                    $product_min_price[$i][0]['unit'],
                    $product_min_price[$i][0]['Store'],
                    $product_min_price[$i][0]['Price'],
                    $products_sum[0],
                    ];  
        }
        //dd($min);
        return view('Authorized_person1.edit', compact(
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
        $data = Authorized_person1::get()->toArray();
        if(empty($data)){
            dd(55);
        }else{
            dd(44);
        }
        $person1 = new Authorized_person1([
                    'keyPR'             =>$request->get('keyPR'),

        ]);
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
