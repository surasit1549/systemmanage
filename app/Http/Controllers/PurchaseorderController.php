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
        $num1 = 0;
        $numberkey = 1;
        $number = 1;
        $porderproduct = product::all()->toArray();
        $porderstore = store::all()->toArray();
        $porderconvert = transform::select('convertname')->distinct()->get();
        $porderdb = porder::all()->toArray();
        $prporder = porder::select('keyPR', 'keystore')
                                                    ->distinct()
                                                    ->addSelect('formwork')
                                                    ->addSelect('date')                                 
                                                    ->get();
        
        foreach($prporder as $row){
            $a[] = $row['keyPR'];
        }
        $key = substr($row['keyPR'], 6,-4);
        $c = sizeof($a);
        for($i=0; $i<$c; $i++){
            if($key != $a[$i]){
                $num1++;
                $orders = strval($num1);
                $keypr[] = "$key-$orders";
            }else{
                $num1 = 1;
                $orders = strval($num1);
                $keypr[] = "$key-$orders";
            }
        }
        //$num = sizeof($a);
        //dd($num);
        //dd($num);
        /*
        $a = ['2015','2015','2016','2017'];
        $b = '2015';
        $c = sizeof($a);
        for($i=0; $i<$c; $i++){
            if($b != $a[$i]){
                $d[] = 1;
            }else{
                $d[] = 2;
            }
        }
        */
        //dd($c);


        foreach($prporder as $row){
            $prporders[] = [
                            $order = $num++,  
                            $row['keyPR'], 
                            $row['formwork'],
                            $row['date'],
                            $keypr
                            
            ];
        }
        //$dfg = strval($prporders[1]);
        //dd($asd);

        $pr = prequest::all()->toArray();
        //dd(gettype($asd));
        //dd($bot);
        return view('porder.index',compact(
                                            'prporder',
                                            'number',
                                            'numberkey',
                                            'prporders',
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
        //$num = intval( $id );
        //dd($pr_product);
        $prporder = porder::select('keyPR', 'keystore')
                                                    ->distinct()                                
                                                    ->get();
        $num_porder = sizeof($prporder);
        $num_store = sizeof($prequeststore);
        //dd($id);
        foreach($product as $row){
            $product1[] = [
                            $row['keyPR'],
                            $row['formwork'],
                            $row['productname'],
                            $row['productnumber'],
                            $row['unit'],
                            $row['keystore'],
                            $row['price'],
                            $row['sum'],
                            $row['id']
            ];
            $product2[] = [
                            $row['id'],
                            $row['keystore']
            ];
        }
        $num = intval( $id );
        //dd($num);
        //dd($product2[1][1]);
        foreach($prequeststore as $row){
            $store1[] = [
                            $row['keystore'],
                            $row['name'],
                            $row['address'],
                            $row['phone'],
                            $row['fax'],
                            $row['contect'],
                            $row['cellphone']
            ];
            $store2[] = [
                            $row['keystore'],
            ];
        }
        for($i=0; $i<$num_porder; $i++){
            if($num === $product2[$i][0]){
                for($j=0; $j<$num_store; $j++)
                    if($product2[$num][1] === $store2[$j][0]){
                        $po_store[] = $store1[$j];
                    }
            }
        }
        dd($po_store);
        /*
        //$ass = [$store2[0],$pr_product2];
        //dd($pr_product2);
        //for($i=0; $i<$num_store; $i++){
                $po_store[] = $product2[$i];
        //} */
        dd($product2);
        //dd(gettype($num));
        return view('porder.show', compact('pr_product'));

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
