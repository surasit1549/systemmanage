<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\purchaserequest;
use App\transform;
use App\prequest;
use App\store;
use App\prequeststore;

class PuchaserequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $prequest = purchaserequest::all()->toArray();
      return view('prequest.index',compact('prequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $prequeststore = store::all()->toArray();
      $prequest = transform::all()->toArray();
    //  dd(gettype('$prequeststore'));
    //  return $prequest;
    //  return $prequeststore;
    //  return view('prequest.create',compact('prequest'));
      return view('prequest.create',compact('prequeststore','prequest'));
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
      $this->validate($request,[
                              'keyPR'   => 'required',
                              'date'        => 'required',
                              'contractor'   => 'required',
                              'formwork'  => 'required',
                              'productname' => 'required',
                              'numberproduct' => 'required',
                              'unit'   => 'required',
                              'price'  => 'required',
                              'sum'    => 'required'

                            ]);
      $่prequest = new purchaserequest(
      [
        'keyPR'   => $request->get('keyPR'),
        'date'          => $request->get('date'),
        'contractor'   => $request->get('contractor'),
        'formwork'   => $request->get('formwork'),
        'productname'   => $request->get('productname'),
        'numberproduct'   => $request->get('numberproduct'),
        'unit'   => $request->get('unit'),
        'price'   => $request->get('price'),
        'sum'   => $request->get('sum'),
      ]
    );

    $่prequest -> save();
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
