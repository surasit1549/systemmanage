<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\porder;
use App\product;
use App\Store;
use App\transform;
use App\prequest;
use App\checkkeystore;
use App\Authorized_person2;
use App\pr_store;

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
        $data = porder::get()->toArray();
        return view('porder.index',compact('data','number'));
 
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
        $po_id = porder::find($id);
        $data = pr_store::where('PO_ID',$po_id['PO_ID'])->get()->toArray();
        $store = Store::where('keystore',$po_id['store_ID'])->get()->toArray();
<<<<<<< HEAD
        //dd($data[0]['sumofprice']);
        $store_mine = Store::where('keystore','master')->get();

=======
        //dd($data);
        $store_mine = Store::where('keystore','master')->get();
>>>>>>> 7e900cdc4d9aba2f2d8f67e95f206f22f50eef3c
        return view('porder.show', compact(
                                            'po_id',
                                            'data',
                                            'store',
                                            'store_mine',
                                            'number',
                                            'id'
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
