<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transform;
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
        $number = 1;
        $num = 1;

        $pr_create = PR_create::all()->toArray();
        if(empty($pr_create)){
          $prequest = $pr_create;
          $pr_prequest = '';
            //dd('ee');
        }else{
            //dd('33');
          foreach($pr_create as $row){
            $pr_prequest[] = [
                                $num_id = $num++,
                                $row['date'],
                                $row['prequestconvert'],
                                $row['formwork'],
                                $row['productname'],
                                $row['productnumber'],
                                $row['unit']
            ];
          }  
        }
        return view('prequest.index', compact(
                                          'pr_create',
                                          'number',
                                          'pr_prequest'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        $pre = prequest::all()->toArray();
        $tran = Transform::all()->toArray();
        return view('pr_create.create', compact('pre', 'tran'));
=======
        $prequestconvert = transform::all()->toArray();
        return view('pr_create.create', compact(
                                            'prequeststore', 
                                            'prequestconvert'
                                          ));
>>>>>>> 171def28955133ebc42c56d17792b1294cc7f5ce
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $lengtharray = sizeof($request->input('name'));

        for ($i = 0; $i < $lengtharray; $i++) {
            $arr = new PR_create([
                'keystore' => $request->input('keystore'),
                'construct_name' => $request->input('construct_name'),
                'typework' => $request->input('typework'),
                'convert' => $request->input('convert')
            ]);
            
            $arr->save();
        }

=======
        dd('dd');
        $lengtharray = sizeof($request->input('name'));
        for ($i = 0; $i < $lengtharray; $i++) {
            $pr_create = new PR_create([
                'date'            => $request->input('date'),
                'formwork'        => $request->input('formwork'),
                'prequestconvert' => $request->input('prequestconvert'),
                'productname'     => $request->input('name')[$i],
                'productnumber'   => $request->input('num')[$i],
                'unit'            => $request->input('unit')[$i]
            ]);

        $pr_create->save();
        }
          return response()->json(['message' => 'success'],200);
>>>>>>> 171def28955133ebc42c56d17792b1294cc7f5ce
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
    { }

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
