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
        $num = 0;
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
        $key[] = substr($row['keyPR'], 6,-4);
        $c = sizeof($a);
        
        //dd($key);
        /*
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
        */

        $nn = 0;
        $data = '22';
        $datas = ['22','22','23','23','24','23','23'];
        $n = sizeof($datas);
        for($i=0; $i<$n-1; $i++){
            $min = $i;
            for($j=$i; $j<$n; $j++){
                if($datas[$j] < $datas[$min]){
                    $min = $j;
                    $temp = $datas[$i];
                    $datas[$i] = $datas[$min];
                    $datas[$min] = $temp;
                }
            }
        }
        $newdatas = $datas;
        //dd($newdatas);
        for($a=0; $a<$n; $a++){
            if($datas[0] === $datas[$a]){
                $nn++;
                $nnn = strval($nn);
                $newdata[] = "$nnn";
            }else {
                $nnn = 1;
                $nnn = strval($nnn);
                $data = $datas[$a];
                $nn = $nnn;
                $newdata[] = "$nnn";
            }
        }
        $summ = [$data,$datas[0],$newdatas,$newdata];
        dd($summ);
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
        $nums = 0;
        $prequeststore = store::all()->toArray();;
        $prequestconvert = transform::all()->toArray();
        $prequestdb = prequest::find($id);
        $productdb = product::find($id);
        $porderdb = porder::find($id);
        $product = product::all()->toArray();
        $porder = porder::all()->toArray();
        $prequestproduct = product::all()->toArray();
        //dd($pr_product);
        $prporder = porder::select('keyPR', 'keystore')
                                                    ->distinct()                                
                                                    ->get();
        //dd($prporder);
        $num_product = sizeof($product);
        $num_store = sizeof($prequeststore);
        $num_poporder = sizeof($prporder);
        //dd($id);
        foreach ($prporder as $row) {
            $po_prporder[] = [  
                                $num_po = $nums++,
                                $row['keystore'],
                                $row['keyPR']
            ];
        }
        
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
                            $row['keystore'],
                            $row['keyPR']
            ]; 
        }
        $num = intval( $id );
        //dd($num_poporder);
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
        foreach($porder as $row){
            $po[] = $row['date'];
        }

        $sum = [$product2[$num][0],$po_prporder[$num][1]];
        //dd($sum);
        
        for($i=0; $i<$num_poporder; $i++){
            if($num === $po_prporder[$i][0]){
                for($j=0; $j<$num_store; $j++){
                    if($po_prporder[$num][1] === $store2[$j][0]){
                        $po_store[] = $store1[$j];
                    }
                }
                for($a=0; $a<$num_product; $a++){
                    if($product2[$a][1] === $po_prporder[$num][2]){
                        if($product2[$a][0] === $po_prporder[$num][1] ){
                            $po_product[] = $product1[$a];
                            $po_date    = $po[$a];
                        }
                    }
                }
            }
        }
        //$number_product = sizeof($po_product);
        //dd($po_product);
        return view('porder.show', compact(
                                            'po_product',
                                            'po_store',
                                            'id',
                                            'po_date',
                                            'po',
                                            'number'
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
