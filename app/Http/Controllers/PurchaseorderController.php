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
            $porders[] = $row['keystore'];
            $porderss[] = $row[ 'date'];
            $pordersss[] = $row[ 'formwork'];
        }
        foreach($porderproduct as $row){
            $product[] = $row['keystore'];
        }
        //$po[] = [$porder , $product];
        $length = sizeof($porders);
        for($i=0; $i<$length-1; $i++){
            $temp1 = $porders[$i];
            $temp2 = $porderss[$i];
            $temp3 = $pordersss[$i]; 
            $sub1 = substr($temp2,8);
            $sub2 = substr($temp2,3,-5);
            $sub3 = $num++;
            $date[] = "$sub1$sub2-$sub3";
            $p1[] = $temp1;
            $p2[] = $temp2;
            $p3[] = $temp3;
            $po[] = [$date, $temp1, $temp2, $temp3];
            for ($j=$i+1; $j<$length; $j++){
                if($product[$j] != $temp1){
                    $temp1 = $j; 
                }
            }
        }
        $l = sizeof($po);
        $pr = prequest::all()->toArray();
        //dd($porderproduct);
        return view('porder.index',compact(
                                            'pr', 
                                            'p1', 
                                            'p2', 
                                            'p3',
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
