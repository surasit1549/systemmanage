<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\PR_create;
use App\Create_product;
use App\product_main;
use App\product_Price;
use App\Authorized_person1;
use Carbon\Carbon;
use App\log;
use Illuminate\Support\Facades\Auth;

class masteroneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prequest = prequest::get()->toArray();
        $pr_create = PR_create::get()->toArray();
        $master = Authorized_person1::get()->toArray();
        $lengtharray = sizeof($prequest);
        for($i=0; $i<$lengtharray; $i++){
            $data = Authorized_person1::where('keyPR',$pr_create[$i]['key'])->get()->toArray();
            
            if(empty($data)){
                $check = "ตรวจสอบ";
            }else{
                $check = "เรียบร้อย";
            }
            $datas[] = [
                $prequest[$i]['id'],
                $prequest[$i]['keyPR'],
                $prequest[$i]['date'],
                $prequest[$i]['formwork'],
                $prequest[$i]['prequestconvert'],
                $prequest[$i]['sumofprice'],
                $check
            ];
        }
        return view('Authorized_person1.index',compact('datas','pr_create'));
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
        $sum = 0;
        $pr_create = PR_create::where('key',$id)->get()->toArray();
        //dd($pr_create[0]['key']);
        $productdb = Create_product::where('key',$pr_create[0]['key'])->get('productname')->toArray();
        $lengtharray = sizeof($productdb);
        //dd($id);
        for($i=0; $i<$lengtharray; $i++){
          $product_id = product_main::where('product_name',$productdb[$i])->get()->toArray();
          $product_price = product_Price::where('Product',$product_id[0]['Product_ID'])->min('Price');
                                        //  ->where('Product',$product_id[0]['Product_ID'])->min('Price');
          $product_min_price[] = product_main::where('product_name',$productdb[$i])
                                           ->join('product__Prices','product_mains.Product_ID','product__Prices.Product')
                                           ->where('Price',$product_price)
                                           ->get()->toArray();
          $product_number = Create_product::where('key',$pr_create[0]['key'])->get()->toArray();  
          //dd($product_min_price[0][0]);   
          $products_sum = [$product_price*$product_number[$i]['productnumber']];
          $sum = [$sum[0]+$products_sum[0]];
          $product_name = product_main::where('Product_ID',$product_min_price[$i][0]['Product_ID'])->get()->toArray();
         
          $min[] = [
                    $product_name[0]['Product_name'],
                    $product_number[$i]['productnumber'],
                    $product_min_price[$i][0]['unit'],
                    $product_min_price[$i][0]['Store'],
                    $product_min_price[$i][0]['Price'],
                    $products_sum[0],
                    ];  
        }
        //dd($min);
        return view('Authorized_person1.edit', compact(
                                              'number',
                                              'pr_create',
                                              'min',
                                              'sum',
                                              'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    function carbon($date_request){
        $date_now = Carbon::now();
        $date_check1 = new Carbon($date_request);
        $date_check2 = new Carbon($date_request);
        $date_1 = $date_check1->startOfMonth();
        $date_2 = $date_check2->addMonth(1)->startOfMonth();
        $str_date = $date_now->toDateString();
        $str_date1 = substr($str_date, 5, -3);
        $str_date2 = substr($str_date, 2, -6);
        $str_dates = "$str_date1$str_date2";
        if ($date_now->between($date_1, $date_2)) {
            $master_id = Authorized_person1::get('key_person')->toArray();
            foreach($master_id as $row){
                $key = $row['key_person'];
            }
            $keys = substr($key, 5);
            $num = intval($keys);
            $num++;
            if ($num < 10) {
                $key_num = strval($num);
                $key = "$str_dates-00$key_num";
                //dd($key);
            } elseif ($num < 100) {
                $key_num = strval($num);
                $key = "$str_dates-0$key_num";
                //dd($key);
            } else {
                $key_num = strval($num);
                $key = "$str_dates-$key_num";
                //dd($key);
            }
        } else {
            $key = "$str_dates-001";
        }

        return($key);
    }

    public function update(Request $request, $id)
    {
        $data = Authorized_person1::get()->toArray();
        if(empty($data)){
            $date_request = $request->get('date');
            $date_1 = substr($date_request,3,-5);
            $date_2 = substr($date_request,8);
            $carbon = $date_1.$date_2."-001";
        }else{
            $date_request = $request->get('date');
            $carbon = $this->carbon($date_request);
        }
        $person1 = new Authorized_person1([
                    'key_person'     =>$carbon,
                    'keyPR'          =>$request->get('keyPR'),

        ]);
        $input = [
            'keyPR' => $request->get('keyPR')
        ];
        $this->insertlog('CONFIRM', 'p_r_creates', $input);
        $person1->save();
        return redirect()->route('Authorized_person1.index')->with('success','เรียบร้อย');

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

    public function insertlog($action, $table, $data)
    {
        Log::create([
            'username' => Auth::user()->username,'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
    
}
