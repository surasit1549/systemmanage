<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\prequestconvert;
use App\store;
use App\prequeststore;
use App\prequestdb;

class PuchaserequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $prequestdb = prequest::all()->toArray();
      return view('prequest.index',compact('prequestdb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $prequeststore = store::all()->toArray();
      $prequestconvert = transform::all()->toArray();
    //  dd(gettype('$prequeststore'));
    //  return $prequest;
    //  return $prequeststore;
    //  return view('prequest.create',compact('prequest'));
      return view('prequest.create',compact('prequeststore','prequestconvert'));
    //  return view('prequest.create')->with('prequest');
    //  return view('prequest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      dd('55');
      $this->validate($request,[
                              'keyPR'           => 'required',      // หมายเลขใบPR
                              'date'            => 'required',      // วันเดือนปี PR
                              'contractor'      => 'required',      // ชื่อผู้รับเหมา
                              'formwork'        => 'required',      // รูปแบบงาน
                              'prequestconvert' => 'required',      // แปลง
                              'productname'     => 'required',      // ชื่อสินค้า
                              'productnumber'   => 'required',      // จำนวนสินค้า
                              'unit'            => 'required',      // หน่วยของสินค้า
                              'keystore'        => 'required',      // หรัสร้านค้า
                              'price'           => 'required',      // ราคาสินค้า
                              'sum'             => 'required'       // จำนวนเงิน

                            ]);
      $่prequestdb = new prequest(
      [
        'keyPR'           => $request->get('keyPR'),
        'date'            => $request->get('date'),
        'contractor'      => $request->get('contractor'),
        'formwork'        => $request->get('formwork'),
        'prequestconvert' => $request->get('transform'),
        'productname'     => $request->get('productname'),
        'productnumber'   => $request->get('numberproduct'),
        'unit'            => $request->get('unit'),
        'keystore'        => $request->get('keystore'),
        'price'           => $request->get('price'),
        'sum'             => $request->get('sum'),
      ]
    );
    $่prequestdb -> save();
    return redirect()->route('prequest.index')->with('success','บันทึกข้อมูลเรียบร้อย');

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
