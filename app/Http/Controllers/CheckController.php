<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\store;
use App\product;
use vendor\autoload;
use App\porder;

use App\Create_product;
use App\PR_create;
use App\product_Price;
use App\product_main;
use App\pr_store;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number = 1;
        $data = porder::get()->toArray();
        return view('check.index',compact('data','number'));
 
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
        $number=1;
        $db = Create_product::get()->toArray();
        $pr_create = PR_create::find($id)->toArray();
        $productdb = Create_product::where('key',$pr_create['key'])->get()->toArray();
        //dd($productdb);
        return view('check.edit', compact(
                                            'number',
                                            'id',
                                            'productdb',
                                            'pr_create'

        ));
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
        $check = $request->get('check');
        $lengthArray = $request->get('product');
        $length = sizeof($lengthArray);
        for($i=0; $i<$length; $i++){
            if($check === 'on'){
                $a[] =  $request->get('check');
                $b[] =  $request->get('product');
            }else{
                $a[] = "ไม่ครบ";
                $b[] = '';
            }
        }
        $sum =[$a,$b];
        dd($sum);
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
