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
                $pr_date = $row['created_at'];
            }
            $pr_num = sizeof($pr_product);
            for($i=$pr_num-1; $i>=0; $i--){
                $pr_products[] = $pr_product[$i];
            }
            //dd($pr_products);
        }
        //dd($pr_product);
        return view('pr_create.index', compact(
                                                'pr_create',
                                                'number',
                                                'pr_products'
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
        return view('pr_create.create', compact('prequestconvert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pr_create = PR_create::all('created_at')->toArray();
        if(empty($pr_create)){
            $key = '001';
        }else{
            $date_date = PR_create::select('date')->distinct()->addSelect('key')->get();
            foreach($date_date as $date){
                $datetime = $date['date'];
                $key      = $date['key'];
            }
            //$key = '120';
            $date_now = Carbon::now();
            $date_check1 = new Carbon($datetime);
            $date_check2 = new Carbon($datetime);
            $date_1 = $date_check1->startOfMonth();
            $date_2 = $date_check2->addMonth(1)->startOfMonth();
            if($date_now->between($date_1,$date_2)){
                $num = intval($key);
                $num++;
                if($num < 10){
                    $key_num = strval($num);
                    $key = "00$key_num";
                    //dd($key);
                }elseif($num < 100){
                    $key_num = strval($num);
                    $key = "0$key_num";
                    //dd($key);
                }else{
                    $key_num = strval($num);
                    $key = "$key_num";
                    //dd($key);
                }
            }else{
                $key = '001';
            }  
        }

        $lengtharray = sizeof($request->input('productname'));
        for ($i = 0; $i < $lengtharray; $i++) {
            $product = new Create_product([
                'key'               => $key,
                'productname'       => $request->input('productname')[$i],
                'productnumber'     => $request->input('productnumber')[$i],
                'unit'              => $request->input('productnumber')[$i]
            ]);
            
            $product->save();
        }
        $arr = new PR_create([
            'key'               => $key,
            'date'              => $request->input('date'),
            'contractor'        => 'เก่ง',
            'formwork'          => $request->input('formwork'),
            'prequestconvert'   => $request->input('prequestconvert'),
        ]);
        
        $arr->save();
        return redirect()->route('pr_create.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
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
