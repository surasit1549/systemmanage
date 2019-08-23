<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
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
use Storage;

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
        //dd($pr_create);
        if (empty($pr_create)) {
            $prequest = $pr_create;
            $pr_products = '';
            //dd('ee');
        } else {
            //dd('33');
            foreach ($pr_create as $row) {
                $pr_product[] = [
                    $num_id = $num++,
                    $row['date'],
                    $row['contractor'],
                    $row['formwork'],
                    $row['prequestconvert'],
                    $row['key'],
                    $row['pdf']
                ];
                $pr_date = $row['created_at'];
            }
            $pr_num = sizeof($pr_product);
            for ($i = $pr_num - 1; $i >= 0; $i--) {
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
        $pr_create = PR_create::all('created_at')->toArray();
        if (empty($pr_create)) {
            $date_now = Carbon::now();
            $str_date = $date_now->toDateString();
            $str_date1 = substr($str_date, 5, -3);
            $str_date2 = substr($str_date, 2, -6);
            $str_dates = "$str_date1$str_date2";
            $key = "$str_dates-001";
        } else {
            $date_date = PR_create::select('date')->distinct()->addSelect('key')->get();
            foreach ($date_date as $date) {
                $datetime = $date['date'];
                $key      = $date['key'];
            }
            //$key = '120';
            $date_now = Carbon::now();
            $date_check1 = new Carbon($datetime);
            $date_check2 = new Carbon($datetime);
            $date_1 = $date_check1->startOfMonth();
            $date_2 = $date_check2->addMonth(1)->startOfMonth();
            $str_date = $date_now->toDateString();
            $str_date1 = substr($str_date, 5, -3);
            $str_date2 = substr($str_date, 2, -6);
            $str_dates = "$str_date1$str_date2";
            //dd($str_dates);
            if ($date_now->between($date_1, $date_2)) {
                $keys = substr($key, 11);
                //dd($keys);
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
        }
        //hidden
        return view('pr_create.create', compact('prequestconvert', 'key'));
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

        // make PDF of pr
        $filepath = 'pdf/' . $request->input('key') . '.pdf';
        $stylesheet = file_get_contents(__DIR__ . '\style.css');
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [210, 297],
            'default_font_size' => 16,
            'default_font' => 'thsarabunnew'
        ]);
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($request->input('filepdf'));
        $mpdf->Output($filepath, 'F');

        // pass pdf of pr to S3
        $path = "C:/xampp/htdocs/project/public/";
        $img_path = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/pr_pdf/' . $request->input('key');
        $s3 = Storage::disk('s3');
        $s3->put('signature/test', file_get_contents($path . 'signature/test.png'), 'public');
        $s3->put('pr_pdf/' . $request->input('key'), file_get_contents($path . $filepath), 'public');

        // Delete File after saving on S3

        unlink($path . $filepath);


        $lengtharray = sizeof($request->input('productname'));
        for ($i = 0; $i < $lengtharray; $i++) {
            $product = new Create_product([
                'key'               => $request->input('key'),
                'productname'       => $request->input('productname')[$i],
                'productnumber'     => $request->input('productnumber')[$i],
                'unit'              => $request->input('productnumber')[$i]
            ]);

            $product->save();
        }
        $arr = new PR_create([
            'key'               => $request->input('key'),
            'date'              => $request->input('date'),
            'contractor'        => 'เก่ง',
            'formwork'          => $request->input('formwork'),
            'prequestconvert'   => $request->input('prequestconvert'),
            'pdf'               => $img_path
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
        //dd($id);
        $number = 1;
        $pr_product = Create_product::all()->toArray();
        $pr_create = PR_create::find($id);
        //dd($pr_create['key']);
        $pr_products = Create_product::where('key', '=', $pr_create['key'])->get();
        //dd($pr_products);
        return view('pr_create.show', compact('pr_create', 'pr_products', 'number', 'id'));
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
