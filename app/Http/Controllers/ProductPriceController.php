<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\product_main;
use App\product_Price;
use Illuminate\Support\Facades\Auth;
use App\log;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number = 1;
        $store_id = product_Price::select('Store')->distinct()->get()->toArray();
        $lengtharray = sizeof($store_id);
        if (empty($store_id)) {
            $store_name = $store_id;
        } else {
            for ($i = 0; $i < $lengtharray; $i++) {
                $store_name[] = Store::where('keystore', $store_id[$i]['Store'])->get()->toArray();
            }
        }
        return view('Product_Price.index', compact('number', 'store_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::all()->toArray();
        $product = product_main::get()->toArray();
        $unit = product_main::select('unit')->distinct()->get();
        //dd($product);
        return view('Product_Price.create', compact('store', 'product', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function cat_ID_New($i)
    {
        $number = $i + 1;
        if ($number < 10) {
            $key_num = strval($number);
            $key = "000$key_num";
        } elseif ($number < 100) {
            $key_num = strval($number);
            $key = "00$key_num";
        } elseif ($number < 1000) {
            $key_num = strval($number);
            $key = "0$key_num";
        } else {
            $key_num = strval($number);
            $key = "$key_num";
        }
        return ($key);
    }

    function cat_ID($id)
    {
        foreach ($id as $row) {
            $id_cat = $row['Cat_ID'];
        }
        $id_cats = substr($id_cat, 9);
        $num = $id_cats + 1;
        if ($num < 10) {
            $key_num = strval($num);
            $key = "000$key_num";
        } elseif ($num < 100) {
            $key_num = strval($num);
            $key = "00$key_num";
        } elseif ($num < 1000) {
            $key_num = strval($num);
            $key = "0$key_num";
        } else {
            $key_num = strval($num);
            $key = "$key_num";
        }
        return ($key);
    }

    public function store(Request $request)
    {
        $lengtharray = sizeof($request->get('product'));
        $Cat_ID = product_Price::get()->toArray();
        $data = '';
        $input = '';
        $store_id = store::where('name', $request->get('store_name'))->addSelect('keystore')->get()->toArray();
        if (empty($Cat_ID)) {
            for ($i = 0; $i < $lengtharray; $i++) {
                $product_id = product_main::where('Product_name', $request->get('Product_name')[$i])->addSelect('Product_ID')->get();
                $ID = $this->cat_ID_New($i);
                $CatID = $ID;
                //dd($ID,$CatID);
                $product_id = product_main::where('Product_name', $request->get('product')[$i])->addSelect('Product_ID')->get()->toArray();
                $Cat_ID = $store_id[0]['keystore'] . '-' . $product_id[0]['Product_ID'] . '-' . $ID;
                $input = [
                        'Cat_ID'            => $Cat_ID,
                        'Store'             => $store_id[0]['keystore'],
                        'Product'           => $product_id[0]['Product_ID'],
                        'Price'             => $request->get('Price')[$i]
                ];
                
                $product_price = new product_Price($input);
                $product_price->save();
                
            }
        } else {
            for ($i = 0; $i < $lengtharray; $i++) {
                $id = product_Price::get('Cat_ID')->toArray();
                $product_id = product_main::where('Product_name', $request->get('product')[$i])->addSelect('Product_ID')->get()->toArray();

                $catid = product_Price::get()->toArray();
                $ID = $this->cat_ID($id);
                $cat = $store_id[0]['keystore'] . '-' . $product_id[0]['Product_ID'] . '-' . $ID;
                $input = [
                    'Cat_ID'            => $cat,
                    'Store'             => $store_id[0]['keystore'],
                    'Product'           => $product_id[0]['Product_ID'],
                    'Price'             => $request->get('Price')[$i]
                ];
                $product_price = new product_Price($input);
                $product_price->save();
            }
        }

        $this->insertlog('CREATE','product_prices',$input);

        return redirect()->route('Product_Price.index')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
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
        $data = product_Price::where('Store', $id)
            ->join('stores', 'product__Prices.Store', 'stores.keystore')
            ->join('product_mains', 'Product__Prices.Product', 'product_mains.Product_ID')
            ->get()->toArray();
        //dd($data);
        return view('Product_Price.show', compact('number', 'data', 'id'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = product_Price::where('Cat_ID', $id)
            ->join('stores', 'product__Prices.Store', 'stores.keystore')
            ->join('product_mains', 'Product__Prices.Product', 'product_mains.Product_ID')
            ->get();
        //dd($data);
        return view('Product_Price.edit', compact('data', 'id'));
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
        $show = $request->get('store_id');
        $input = [
            'Store' => $request->get('store_id'),
            'Cat_ID'       => $request->get('Cat_ID'),
            'Product'      => $request->get('product_id'),
            'Price'        => $request->get('Price')
        ];

        product_Price::where('Cat_ID', $id)->update($input);
        $this->insertlog('UPDATE','product_prices',$input);
        return redirect()->route('Product_Price.show', $show)->with('success', 'อัพเดทเรียบร้อย');
        //$this->show($show);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store_name = Store::find($id);
        $product_price = product_Price::where('Store', $store_name['keystore'])->get();
        $lengtharray = sizeof($product_price);
        for ($i = 0; $i < $lengtharray; $i++) {
            $product_price[$i]->delete();
        }
        $input = [
            'Cat_ID' => $store_name->Store
        ];
        $this->insertlog('DELETE','product_prices',$input);
        //$product_price->delete();
        return redirect()->route('Product_Price.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function deletename($id){
        dd($id);
    }

    public function insertlog($action, $table, $data)
    {
        Log::create([
            'username' => Auth::user()->username, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
}