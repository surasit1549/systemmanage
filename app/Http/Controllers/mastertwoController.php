<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\PR_create;
use App\Create_product;
use App\product_main;
use App\product_Price;
use App\Authorized_person1;
use App\Authorized_person2;
use Carbon\Carbon;
use App\porder;
use App\pr_store;
use App\Store;
use App\log;
use App\Product;
use Auth;

class mastertwoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Authorized_person1::join('prequests', 'authorized_person1s.keyPR', 'prequests.keyPR')->get()->toArray();
        return view('Authorized_person2.index', compact('data'));
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
        $pr_create = PR_create::where('key', $id)->get()->toArray();
        $productdb = Create_product::where('key', $pr_create[0]['key'])->get('productname')->toArray();
        $data = Authorized_person2::get()->toArray();
        $lengtharray = sizeof($productdb);
        for ($i = 0; $i < $lengtharray; $i++) {
            $product_id = product_main::where('product_name', $productdb[$i])->get()->toArray();
            $product_price = product_Price::where('Product', $product_id[0]['Product_ID'])->min('Price');
            //  ->where('Product',$product_id[0]['Product_ID'])->min('Price');
            $product_min_price[] = product_main::where('product_name', $productdb[$i])
                ->join('product__Prices', 'product_mains.Product_ID', 'product__Prices.Product')
                ->where('Price', $product_price)
                ->get()->toArray();
            $product_number = Create_product::where('key', $pr_create[0]['key'])->get()->toArray();
            //dd($product_min_price[0][0]);   
            $products_sum = [$product_price * $product_number[$i]['productnumber']];
            $sum = [$sum[0] + $products_sum[0]];
            $product_name = product_main::where('Product_ID', $product_min_price[$i][0]['Product_ID'])->get()->toArray();
            $min[] = [
                $product_name[0]['Product_name'],
                $product_number[$i]['productnumber'],
                $product_min_price[$i][0]['unit'],
                $product_min_price[$i][0]['Store'],
                $product_min_price[$i][0]['Price'],
                $products_sum[0],
            ];
            $stores[] = Store::where('keystore', $product_min_price[$i][0]['Store'])->get()->toArray();
        }
        return view('Authorized_person2.edit', compact(
            'number',
            'pr_create',
            'min',
            'sum',
            'stores',
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

    function carbon($date_request)
    {
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
            $master_id = Authorized_person2::get('key_person')->toArray();
            foreach ($master_id as $row) {
                $key = $row['key_person'];
            }
            $keys = substr($key, 5);
            $num = intval($keys);
            $num++;
            if ($num < 10) {
                $key_num = strval($num);
                $key = "$str_dates-00$key_num";
            } elseif ($num < 100) {
                $key_num = strval($num);
                $key = "$str_dates-0$key_num";
            } else {
                $key_num = strval($num);
                $key = "$str_dates-$key_num";
            }
        } else {
            $key = "$str_dates-001";
        }
        return ($key);
    }

    function po($date_request, $stores)
    {
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
            $master_id = Authorized_person2::get('PO_ID')->toArray();
            foreach ($master_id as $row) {
                $key = $row['PO_ID'];
            }
            $keys = substr($key, 5);
            $num = intval($keys);
            $num++;
            if ($num < 10) {
                $key_num = strval($num);
                $key = "$str_dates-00$key_num";
            } elseif ($num < 100) {
                $key_num = strval($num);
                $key = "$str_dates-0$key_num";
            } else {
                $key_num = strval($num);
                $key = "$str_dates-$key_num";
            }
        } else {
            $key = "$str_dates-001";
        }
        return ($key);
    }

    public function update(Request $request, $id)
    {
        $data = Authorized_person2::get()->toArray();
        $date_request = $request->get('date');
        $store = $request->get('keystore');
        $key_pr = $request->get('keyPR');
        $store_name = Product::where('keyPR', $key_pr)->select('Store')
            ->distinct()
            ->addSelect('keyPR')
            ->get()->toArray();
        $lengthall = sizeof($store_name);
        if (empty($data)) {
            $date_1 = substr($date_request, 3, -5);
            $date_2 = substr($date_request, 8);
            $carbon = $date_1 . $date_2 . "-001";
            $keys = substr($carbon, 5);
            $num = intval($keys);
            $key_num = 0;

            for ($i = 0; $i < $lengthall; $i++) {
                $stores_name = Product::where('keyPR', $store_name[$i]['keyPR'])->where('Store', $store_name[$i]['Store'])->get()->toArray();
                $lengtharray = sizeof($stores_name);
                $num = $num + $key_num;
                if ($num < 10) {
                    $key_num = strval($num);
                    $PO = "$date_1$date_2-00$key_num";
                } elseif ($num < 100) {
                    $key_num = strval($num);
                    $PO = "$date_1$date_2-0$key_num";
                } else {
                    $key_num = strval($num);
                    $PO = "$date_1$date_2-$key_num";
                }

                $master2 = new Authorized_person2([
                    'PO_ID'          => $PO,
                    'key_person'     => $carbon,
                    'keyPR'          => $request->get('keyPR'),
                ]);
                $master2->save();

                $porder = new porder([
                    'PO_ID'         => $PO,
                    'keyPR'         => $request->get('keyPR'),
                    'store_ID'      => $stores_name[$i]['Store'],
                    'status'        => "ยังไม่ได้รับของ",
                ]);
                $porder->save();
                for ($j = 0; $j < $lengtharray; $j++) {
                    $pr_store = new pr_store([
                        'PO_ID'         => $PO,
                        'keyPR'         => $request->get('keyPR'),
                        'Product_name'  => $stores_name[$j]['Product_name'],
                        'Product_number' => $stores_name[$j]['Product_number'],
                        'unit'          => $stores_name[$j]['unit'],
                        'keystore'      => $stores_name[$j]['Store'],
                        'price'         => $stores_name[$j]['price'],
                        'product_sum'   => $stores_name[$j]['product_sum'],
                        'sumofprice'    => $stores_name[$j]['sumallprice'],
                        'status'        => "ยังไม่รับ",
                    ]);
                    $pr_store->save();
                }
            }
        } else {
            for ($i = 0; $i < $lengthall; $i++) {
                $stores_name = Product::where('keyPR', $store_name[$i]['keyPR'])->where('Store', $store_name[$i]['Store'])->get()->toArray();
                $lengtharray = sizeof($stores_name);
                $stores = $store[$i];
                if ($i === 0) {
                    $carbon = $this->carbon($date_request);
                    $PO     = $this->po($date_request, $stores);

                    $master2 = new Authorized_person2([
                        'PO_ID'          => $PO,
                        'key_person'     => $carbon,
                        'keyPR'          => $request->get('keyPR'),
                    ]);
                    $master2->save();

                    $porder = new porder([
                        'PO_ID'         => $PO,
                        'keyPR'         => $request->get('keyPR'),
                        'store_ID'      => $stores_name[0]['Store'],
                        'status'        => "ยังไม่ได้รับของ",
                    ]);
                    $porder->save();
                    for ($j = 0; $j < $lengtharray; $j++) {
                        $pr_store = new pr_store([
                            'PO_ID'         => $PO,
                            'keyPR'         => $request->get('keyPR'),
                            'Product_name'  => $stores_name[$j]['Product_name'],
                            'Product_number' => $stores_name[$j]['Product_number'],
                            'unit'          => $stores_name[$j]['unit'],
                            'keystore'      => $stores_name[$j]['Store'],
                            'price'         => $stores_name[$j]['price'],
                            'product_sum'   => $stores_name[$j]['product_sum'],
                            'sumofprice'    => $stores_name[$j]['sumallprice'],
                            'status'        => "ยังไม่รับ",
                        ]);
                        $pr_store->save();
                    }
                } else {
                    $data1 = porder::where('keyPR', $request->get('keyPR'))->get()->toArray();
                    if ($data1[0]['store_ID'] === $stores) {
                        for ($j = 0; $j < $lengtharray; $j++) {
                            $pr_store = new pr_store([
                                'PO_ID'         => $PO,
                                'keyPR'         => $request->get('keyPR'),
                                'Product_name'  => $stores_name[$j]['Product_name'],
                                'Product_number' => $stores_name[$j]['Product_number'],
                                'unit'          => $stores_name[$j]['unit'],
                                'keystore'      => $stores_name[$j]['Store'],
                                'price'         => $stores_name[$j]['price'],
                                'product_sum'   => $stores_name[$j]['product_sum'],
                                'sumofprice'    => $stores_name[$j]['sumallprice'],
                                'status'        => "ยังไม่รับ",
                            ]);
                            $pr_store->save();
                        }
                    } else {
                        $carbon = $this->carbon($date_request);
                        $PO     = $this->po($date_request, $stores);
                        $master2 = new Authorized_person2([
                            'PO_ID'          => $PO,
                            'key_person'     => $carbon,
                            'keyPR'          => $request->get('keyPR'),
                        ]);
                        $master2->save();
                        $porder = new porder([
                            'PO_ID'         => $PO,
                            'keyPR'         => $request->get('keyPR'),
                            'store_ID'      => $stores_name[0]['Store'],
                            'status'        => "ยังไม่ได้รับของ",
                        ]);
                        $porder->save();
                        for ($j = 0; $j < $lengtharray; $j++) {

                            $pr_store = new pr_store([
                                'PO_ID'         => $PO,
                                'keyPR'         => $request->get('keyPR'),
                                'Product_name'  => $stores_name[$j]['Product_name'],
                                'Product_number' => $stores_name[$j]['Product_number'],
                                'unit'          => $stores_name[$j]['unit'],
                                'keystore'      => $stores_name[$j]['Store'],
                                'price'         => $stores_name[$j]['price'],
                                'product_sum'   => $stores_name[$j]['product_sum'],
                                'sumofprice'    => $stores_name[$j]['sumallprice'],
                                'status'        => "ยังไม่รับ",
                            ]);
                            $pr_store->save();
                        }
                    }
                }
            }
        }
        $inputa = [
            'keyPR' => $request->get('keyPR')
        ];
        $inputb = [
            'PO_ID' => $PO
        ];
        $this->insertlog('CONFIRM', 'p_r_creates', $inputa);
        $this->insertlog('CREATE', 'porders', $inputb);
        return redirect()->route('Authorized_person2.index')->with('success', 'เรียบร้อย');
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
            'username' => Auth::user()->username, 'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
}
