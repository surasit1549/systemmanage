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
        $lengtharray = sizeof($request->input('productname'));
        $now = Carbon::now(-5);

        // Signature from user

        $data_uri = $request->input('image');
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        file_put_contents("signature/test.png", $decoded_image);


        // PDF

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            'orientation' => 'L'
        ]);

        $mpdf->WriteHTML('สวัสดีครับ');
        $mpdf->Output('pdf/test.pdf','F');
        //dd($now->timezone);
        //dd($request->input('productnumber'));
        for ($i = 0; $i < $lengtharray; $i++) {
            $product = new Create_product([
                'key'               => '001',
                'productname'       => $request->input('productname')[$i],
                'productnumber'     => $request->input('productnumber')[$i],
                'unit'              => $request->input('productnumber')[$i]
            ]);
            
            $product->save();
        }
        $arr = new PR_create([
            'key'               => '001',
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
