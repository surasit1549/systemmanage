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
        $number = 1;
        $po_id = porder::find($id);
        $data = pr_store::where('PO_ID',$po_id['PO_ID'])->get()->toArray();
        $store = Store::where('keystore',$po_id['store_ID'])->get()->toArray();
        //dd($productdb);
        return view('check.edit', compact(
                                    'po_id',
                                    'data',
                                    'store',
                                    'number',
                                    'id'
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
        $porder_old = porder::find($id);
        $lengthArray = $request->get('product');
        $PO_ID = $request->PO_ID;
        $product = pr_store::where('PO_ID',$PO_ID)->get()->toArray();
        $length = sizeof($lengthArray);
        for($i=0; $i<$length; $i++){
            if($check[$i] === "รับ"){
                $status =  "ครบ";
            }else{
                $status = "ไม่ครบ";
                break;
            }
        }

        
        $porder = porder::find($id);
        $porder->PO_ID           = $porder_old['PO_ID'];
        $porder->keyPR           = $porder_old['keyPR'];
        $porder->store_ID        = $porder_old['store_ID'];
        $porder->status          = $status;
        $porder->save();
        return redirect()->route('check.index')->with('success','เรียบร้อยแล้ว');
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
