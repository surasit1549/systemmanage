<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Porder;
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
use App\z1;
use App\z2;

class PurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $number = 1;
        $porderproduct = product::all()->toArray();
        $porderstore = store::all()->toArray();
        $porderconvert = transform::all()->toArray();
        //return view('porder.index');
        //dd(gettype('$z1'));
        $num1 = 0;
        $num2;
        $z1 = '0';
        //dd(gettype($number));
        $z2 = '0';
        $pr = prequest::all()->toArray();
        //dd($porderproduct);
        //dd($pr);
        //return $pr;
        //dd(gettype('$pr'));
        //dd('55');
        return view('porder.index',compact('pr', 'porderstore', 'pordertransform', 'num1', 'z1', 'z2', 'num2', 'number', 'porderproduct'));
 
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
