<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_main;
use App\log;
use App\Main_group;
use App\Small_group;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $num = 1;
        $number = 1;
        $product = product_main::all()->toArray();
        if (empty($product)) {
            $products = $product;
        }
        foreach ($product as $row) {
            $products[] = [
                $row['id'],
                $row['Product_ID'],
                $row['Product_name'],
                $row['unit']
            ];
        }
        //dd($products);
        return view('Product.index', compact('products', 'num'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $small_check = Small_group::select('Main_group')->distinct()->get();
        $small_group = Small_group::select('Small_group')->distinct()->get();
        //dd($small_group);
        return view('Product.create', compact('small_check','small_group'));
    }

    public function check(Request $request)
    {
        $small_check = Small_group::where('Main_group',$request->Main_group)->select('Main_group')->distinct()->AddSelect('Small_group')->get();
        //return view('Product.create', compact('small_check'));
        return response()->json(['msg' => $small_check]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Product_ID1'        => 'required',
            'Product_ID2'        => 'required',
            'Product_name'       => 'required',
            'unit'               => 'required'
        ]);

        //------ KEY ------------//


        $product = product_main::all()->toArray();
        $ID = product_main::select('Product_ID')->distinct()->get();
        foreach ($ID as $row) {
            $product_id = $row['Product_ID'];
        }
        if (empty($product)) {
            $key = "0001";
        } else {
            $number = intval(explode('-', $product_id)[2]);
            $number++;
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
        }

        // ------------------- //
        $main_check = Main_group::where('Main_group',$request->Product_ID1)->get()->toArray();
        if(empty($main_check)){
            $main_group = new Main_group(
                [
                    'Main_group'        => $request->Product_ID1
                ]
            );
            $main_group->save();
        }
        $small_check = Small_group::where('Main_group',$request->Product_ID1)->where('Small_group',$request->Product_ID2)->get()->toArray();
        
        if(empty($small_check)){
            $small_group = new Small_group(
                [
                    'Main_group'        => $request->Product_ID1,
                    'Small_group'       => $request->Product_ID2
                ]
            );
            $small_group->save();
        }
        $product_id = $request->Product_ID1 . '-' . $request->Product_ID2 . '-' . $key;
        $product = new product_main(
            [
                'Product_ID'        => $product_id,
                'Product_name'      => $request->get('Product_name'),
                'unit'              => $request->get('unit')
            ]
        );
        $product->save();
        $data = [
            'Product_ID' => $request->Product_ID,
            'Product_name' => $request->Product_name,
            'unit' => $request->unit
        ];
        $this->insertlog('CREATE', 'product_mains', $data);
        return redirect()->route('Product.index')->with('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
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
        $product = product_main::find($id);
        //dd($product);
        $product->save();
        return view('product.edit', compact('product', 'id'));
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
        $this->validate(
            $request,
            [
                'Product_ID'      => 'required',
                'Product_name'    => 'required',
                'unit'            => 'required'
            ]
        );

        //dd($id);
        $product = product_main::find($id);
        $input = [
            'Product_ID' => $request->get('Product_ID'),
            'Product_name'    => $request->get('Product_name'),
            'unit'            => $request->get('unit')
        ];
        //$product->update($input);
        //$this->insertlog('UPDATE', 'product_mains', $input);
        return redirect()->route('Product.index')->with('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product_main::find($id);
        $input = [
            'Product_ID' => $product->Product_ID
        ];
        $this->insertlog('DELETE', 'product_mains', $input);
        $product->delete();
        return redirect()->route('Product.index')->with('success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }

    public function insertlog($action, $table, $data)
    {
        Log::create([
            'username' => Auth::user()->username, 'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
}
