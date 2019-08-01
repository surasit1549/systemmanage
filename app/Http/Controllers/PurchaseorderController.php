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
        for($i=0; $i<$length-1; $i++){
            for ($j=$i+1; $j<$length; $j++){
                if($porder1[$j] != $porder1[$i]){
                /*    $porders[$i];
                    $porderss[$i];
                    $pordersss[$i]; 
                    $temp1[] = $porders[$j];    */
                    $temp2 = $porder2[$j];
                    $sub1 = substr($temp2,8);
                    $sub2 = substr($temp2,3,-5);
                    $sub3 = $num++;
                    $date[] = "$sub1$sub2-$sub3";
                    //$temp1 = $j; 
                    
                }
            }
            $temp1[] = $porder1[$i];
            $temp3[] = $porder3[$i];
            $temp4[] = $porder2[$i];
            $temp5[] = $porder4[$i];
            $temp6[] = $porder5[$i];
            $po[] = [$date, $porder1[$i], $porder2[$i], $porder3[$i]];
        }
        dd($length);
        $l = sizeof($po);
        $s = sizeof($date);
        $pr = prequest::all()->toArray();
        dd($l);

        //dd($porderproduct);
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
        $number;
        $prequeststore = store::all()->toArray();;
        $prequestconvert = transform::all()->toArray();
        $prequestdb = prequest::find($id);
        $productdb = product::find($id);
        $porderdb = porder::find($id);
        $porder = porder::all()->toArray();
        $prequestproduct = product::all()->toArray();
        //dd($prequestproduct);
        $num = $id;

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

        foreach($porderdb as $row){
            $porder1[] = $row['id'];
            $porder2[] = $row['keystore'];
        }

        $number = sizeof($porder1);
        dd($number);
        dd($num);
        return view('porder.show', compact(
                                            'prequestdb', 
                                            'prequeststore', 
                                            'prequestconvert', 
                                            'prequestproduct', 
                                            'id', 
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
