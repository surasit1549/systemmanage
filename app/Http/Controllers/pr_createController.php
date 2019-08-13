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
use App\Create_product;
use Carbon\Carbon;
use App\pr_create;

use vendor\autoload;

$asd = 0;

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
            $pr_product = '';
            //dd('ee');
        }else{
            //dd('33');
            foreach($pr_create as $row){
                $pr_product[] = [
                                $num_id = $num++,
                                $row['date'],
                                $row['contractor'],
                                $row['formwork'],
                                $row['prequestconvert']
                ];
            }
        }
        //dd($pr_product);
        return view('pr_create.index', compact(
                                                'pr_create',
                                                'number',
                                                'pr_product'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prequestconvert = transform::all()->toArray();
        return view('pr_create.create', compact('prequestconvert' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $num = 0;
        $date = "01";
        $date_one = "01";
<<<<<<< HEAD
=======

        $pr_create = PR_create::all()->toArray();
        if(empty($pr_create)){
            $key = "001";
        }else{
            $sum_key = intval($key);
            $sum_key++;
        }
>>>>>>> df308ef2cff9fe3ed1d9dc27b02a41a6f1e3a627
        $lengtharray = sizeof($request->input('productname'));

        $date = $request->input('date');
        $date1 = substr($date,3,-5);
        $date2 = substr($date,8);
        $dates = "$date1$date2";

        $date = Carbon::today()->addday(3);
        $dates = substr($date,8,-9);
        if($date_one == $dates){
            $key;
            //dd($sum);
        }else{
            $sum++;

            //dd($sum);
        }
        //dd($dates);

        $date_time = today();
        //dd($date_time);

        for ($i = 0; $i < $lengtharray; $i++) {
            $product = new Create_product([
                'key'               => $sum,
                'productname'       => $request->input('productname')[$i],
                'productnumber'     => $request->input('productnumber')[$i],
                'unit'              => $request->input('productnumber')[$i]
            ]);
            
            $product->save();
        }
        $arr = new PR_create([
            'key'               => $sum,
            'date'              => $request->input('date'),
            'contractor'        => 'เก่ง',
            'formwork'          => $request->input('formwork'),
            'prequestconvert'   => $request->input('prequestconvert'),
        ]);
        
        $arr->save();

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
