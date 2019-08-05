<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\porderdb;
use App\porder;
use App\prporder;
use App\prequest;
use App\porderstore;
use App\store;
use App\porderconvert;
use App\transform;
use App\proderproduct;
use App\product;
use App\number;
use App\checkkeystore;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {  
        
        $num = 1;
        $number = 1;
        $n;
        $porderproduct = product::all()->toArray();
        $porderstore = store::all()->toArray();
        $porderconvert = transform::select('convertname')->distinct()->get();
        $porderdb = porder::all()->toArray();
        $prporder = porder::select('keyPR', 'keystore')
                                                    ->distinct()
                                                    ->addSelect('formwork')
                                                    ->addSelect('date')
                                                    
                                                    ->get();
        
        $n = sizeof($prporder);

        //dd($prporder);

        $pr = prequest::all()->toArray();
        //dd(gettype($temp5));
        //dd($bot);
        return view('porder.index',compact(
                                            'prporder',
                                            'date', 
                                            'number',
                                            'n',
                                            'num'                                        
        ));
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('porder.create');
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
        $number = 1;
        $prequeststore = store::all()->toArray();;
        $prequestconvert = transform::all()->toArray();
        $prequestdb = prequest::find($id);
        $productdb = product::find($id);
        $porderdb = porder::find($id);
        $product = product::all()->toArray();
        $porder = porder::all()->toArray();
        $prequestproduct = product::all()->toArray();
        //dd($prequestproduct);
        $num = intval( $id );
        //dd($num);

        foreach($product as $row){
            $product1[] = $row['keyPR'];
            $product2[] = $row['formwork'];
            $product3[] = $row['productname'];
            $product4[] = $row['productnumber'];
            $product5[] = $row['unit'];
            $product6[] = $row['keystore'];
            $product7[] = $row['price'];
            $product8[] = $row['sum'];
            $product9[] = $row['id'];
        }

        foreach($prequeststore as $row){
            $store1[] = $row['id'];
            $store2[] = $row['keystore'];
            $store3[] = $row['name'];
            $store4[] = $row['address'];
            $store5[] = $row['phone'];
            $store6[] = $row['fax'];
            $store7[] = $row['contect'];
            $store8[] = $row['cellphone'];
        }

        foreach($porder as $row){
            $porder1[] = $row['id'];
            $porder2[] = $row['keystore'];
            $porder3[] = $row['date'];
            $porder4[] = $row['keyPR'];
        }
        $number1 = sizeof($porder1);
        $number2 = sizeof($store1);
        $number3 = sizeof($product9);
        //dd($num);
        
        for($i=0; $i<$number1; $i++){
            if($porder1[$i] === $num){
                for($j=0; $j<$number2; $j++){
                    if($store2[$j] === $porder2[$i]){
                        $store[] = [
                                    $store2[$j], 
                                    $store3[$j], 
                                    $store4[$j],
                                    $store5[$j],
                                    $store6[$j],
                                    $store7[$j],
                                    $store8[$j]
                        ];
                        $po = $porder3[$j];
                    }
                    
                }
                for($a=0; $a<$number3; $a++){
                    if($product9[$a] === $porder1[$num] && $product6[$a] === $porder2[$num]){
                        $products = [
                            $product1[$a], 
                            $product2[$a],
                            $product3[$a],
                            $product4[$a],
                            $product5[$a],
                            $product6[$a],
                            $product7[$a],
                            $product8[$a],
                            $product9[$a],
                        ];
                    }
                }
            }

           
        }
        $c = sizeof($products[8]);
        dd($product9);
        //dd($po);
        //dd($store);
        //dd(gettype($num));
        return view('porder.show', compact(
                                            'prequestdb', 
                                            'prequeststore', 
                                            'prequestconvert', 
                                            'prequestproduct', 
                                            'id', 
                                            'number',
                                            'store',
                                            'po',
                                            'products',
                                            'number3'
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
