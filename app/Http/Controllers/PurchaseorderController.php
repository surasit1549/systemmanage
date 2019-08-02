<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\porderdb;
use App\porder;
use App\pr;
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
        $porderproduct = product::all()->toArray();
        $porderstore = store::all()->toArray();
        $porderconvert = transform::all()->toArray();
        $porderdb = porder::all()->toArray();
        foreach($porderdb as $row){
            $porder1[] = $row['keystore'];
            $porder2[] = $row['date'];
            $porder3[] = $row['formwork'];
            $porder4[] = $row['id'];
            $porder5[] = $row['keyPR'];
        }
        foreach($porderproduct as $row){
            $product[] = $row['keystore'];
        }
        //$po[] = [$porder , $product];
        $length = sizeof($porderdb);
        $key = 0;

        
        for($i=0; $i<$length-1; $i++){
            if($i > $key){
                for ($j=$i+1; $j<$length; $j++){
                        if($porder5[$j] === $porder5[$i] ){
                            
                                $a[] = $porder5[$j];
                                $b[] = $porder5[$i];
                                $k[] = $i;
                                $data[] = $porder5[$j];
                                break;
                        }  
                        break;
                }
                $key = $j;
                
            }

            //break;
        }
        $number1 = sizeof($data);
        $number2 = $number1;
        
        for($b=0; $b<$number2; $b++){
            for ($c=$b+1; $c<$length; $c++){
                if($porder5[$c] === $data[$b]){
                    $data2[] = $porder5[$c];
                }
            }
            $data1[] = $data[$b];
            //break;
        }   
        $data3 = [$data1,$data2];
        $datanum = sizeof($data2);
        

        dd($data3);
        $l = sizeof($po);
        $s = sizeof($date);
        $pr = prequest::all()->toArray();
        //dd(gettype($temp5));
        //dd($bot);
        return view('porder.index',compact(
                                            'pr', 
                                            'temp1', 
                                            'temp3', 
                                            'temp4',
                                            'temp5',
                                            'date', 
                                            'number', 
                                            'l'                                         
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
