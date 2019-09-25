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
        $store = Store::where('name',$po_id['store_ID'])->get()->toArray();
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
        $porder_old = porder::where('PO_ID',$id)->get();
        $lengthArray = $request->get('product');
        $PO_ID = $request->PO_ID;
        $keystore = $request->keystore;
        $pr_store = pr_store::where('PO_ID', $porder_old[0]['PO_ID'])->where('keystore',$porder_old[0]['store_ID'])->get()->toArray();
        $length = sizeof($pr_store);
        $pr_stores = pr_store::where('PO_ID', $porder_old[0]['PO_ID'])->where('keystore',$porder_old[0]['store_ID'])->get();
        //dd($pr_stores);
        for($j=0; $j<$length; $j++){
            $pr_stores[$j]->PO_ID            = $pr_store[$j]['PO_ID'];
            $pr_stores[$j]['keyPR']            = $pr_store[$j]['keyPR'];
            $pr_stores[$j]['Product_name']     = $pr_store[$j]['Product_name'];
            $pr_stores[$j]['Product_number']   = $pr_store[$j]['Product_number'];
            $pr_stores[$j]['unit']             = $pr_store[$j]['unit'];
            $pr_stores[$j]['keystore']         = $pr_store[$j]['keystore'];
            $pr_stores[$j]['price']            = $pr_store[$j]['price'];
            $pr_stores[$j]['product_sum']      = $pr_store[$j]['product_sum'];
            $pr_stores[$j]['sumofprice']       = $pr_store[$j]['sumofprice'];
            $pr_stores[$j]['status']           = $check[$j];
            $pr_stores[$j]->save();
        }
        for($i=0; $i<$length; $i++){
            if($check[$i] === "รับ"){
                $status =  "ครบ";
            }else{
                $status = "ไม่ครบ";
                break;
            }
        }
        $porder = porder::where('PO_ID',$id)->get();
        $porder[0]->PO_ID           = $porder_old[0]['PO_ID'];
        $porder[0]->keyPR           = $porder_old[0]['keyPR'];
        $porder[0]->store_ID        = $porder_old[0]['store_ID'];
        $porder[0]->status          = $status;
        $porder[0]->save();
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
