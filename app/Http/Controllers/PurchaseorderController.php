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
use App\num1;
use App\num2;
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
        function pos($porderdb,$porderproduct)
        {
        foreach($porderdb as $row){
            $po[] = $row['keystore'];
        }
        return $po;
        }
        $number = 1;
        $porderproduct = product::all()->toArray();
        $porderstore = store::all()->toArray();
        $porderconvert = transform::all()->toArray();
        $porderdb = porder::all()->toArray();
    
        pos($porderdb,$porderproduct);  
        $num2 = pos($porderdb,$porderproduct);
        dd($num2);      
        //$num2;
        $pr = prequest::all()->toArray();
        //dd($porderproduct);
        return view('porder.index',compact('pr', 'po', 'porderdb', 'porderstore', 'pordertransform', 'num1', 'z1', 'z2', 'num2', 'number', 'porderproduct'));
 
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
