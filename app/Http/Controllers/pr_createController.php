<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\prequestconvert;
use App\store;
use App\prequeststore;
use App\prequestdb;
use App\product;
use App\productdb;
use App\prequestproduct;
use App\number;
use App\porderdb;
use App\porder;

use App\pr_create;

use vendor\autoload;

class pr_createController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pr_create.index');
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
        $stores = store::all()->toArray();
        return view('pr_create.create', compact(
                                            'prequeststore', 
                                            'prequestconvert',
                                            'stores'
                                          ));
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
        $lengtharray = sizeof($request->input('name'));

        for ($i = 0; $i < $lengtharray; $i++) {
          $pr_create = new Product([
                'date'            => $request->input('date'),
                'contractor'      => $request->input('contractor'),
                'formwork'        => $request->input('formwork'),
                'prequestconvert' => $request->input('prequestconvert'),
                'productname'     => $request->input('name')[$i],
                'productnumber'   => $request->input('num')[$i],
                'unit'            => $request->input('units')[$i],
            ]);
        
            $pr_create->save();
        }
          return response()->json(['message' => 'success'],200);
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
