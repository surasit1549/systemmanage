<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\transform;
use App\store;
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
use App\product_main;
use App\prequest;
use App\Authorized_person1;
use App\Authorized_person2;
use Illuminate\Support\Facades\Auth;
use App\log;

class pr_createController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function makepdf(Request $request)
    {
        $stylesheet = file_get_contents(__DIR__ . '\style.css');
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [210, 297],
            'default_font_size' => 14,
            'default_font' => 'thsarabunnew'
        ]);
        $key = $request->keypr;
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($request->pdf, 2);
        $mpdf->Output("pdf/$key.pdf", 'F');
        return response()->json(['msg' => 'Succesful']);
    }

    public function index()
    {
        $number = 1;
        $num = 1;
        $keypr = prequest::get()->toArray();
        $pr_create = PR_create::all()->toArray();
        if (empty($pr_create)) {
            $prequest = $pr_create;
            $pr_products = '';
            $status = '';
        } else {
            $lengtharray = sizeof($pr_create);
            for ($i = 0; $i < $lengtharray; $i++) {

                $master1 = Authorized_person1::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
                $master2 = Authorized_person2::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
                if (empty($keypr[$i])) {
                    $status = "0";
                } elseif ($keypr != NULL && empty($master1) && empty($master2)) {
                    $status = "1";
                } elseif ($keypr != NULL && $master1 != NULL && empty($master2)) {
                    $status = "2";
                } elseif ($keypr != NULL && $master1 != NULL && $master2 != NULL) {
                    $status = "3";
                }
                $pr_product[] = [
                    $pr_create[$i]['id'],
                    $pr_create[$i]['date'],
                    $pr_create[$i]['contractor'],
                    $pr_create[$i]['formwork'],
                    $pr_create[$i]['prequestconvert'],
                    $pr_create[$i]['key'],
                    $status
                ];
            }
            $pr_num = sizeof($pr_product);
            for ($i = $pr_num - 1; $i >= 0; $i--) {
                $pr_products[] = $pr_product[$i];
            }
        }
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
        $number = 1;
        $prequestconvert = transform::all()->toArray();
        $pr_create = PR_create::all('created_at')->toArray();
        $product = product_main::all()->toArray();
        $unit = product_main::select('unit')->distinct()->get();

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
            $date_now = Carbon::now();
            $date_check1 = new Carbon($datetime);
            $date_check2 = new Carbon($datetime);
            $date_1 = $date_check1->startOfMonth();
            $date_2 = $date_check2->addMonth(1)->startOfMonth();
            $str_date = $date_now->toDateString();
            $str_date1 = substr($str_date, 5, -3);
            $str_date2 = substr($str_date, 2, -6);
            $str_dates = "$str_date1$str_date2";
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
        return view('pr_create.create', compact('prequestconvert', 'key', 'product', 'unit', 'number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        dd($request->productname);
        $this->validate(
            $request,
            [
                'key'               => 'required',
                'formwork'          => 'required',
                'prequestconvert'   => 'required',
                'productname'       => 'required',
                'productnumber'     => 'required',
                'unit'              => 'required',

            ]
        );


        $num = 0;
        $key = $request->input('key');
        $ID = $request->input('prequestconvert') . '-' . $key;
        $lengtharray = sizeof($request->input('productname'));


        for ($i = 0; $i < $lengtharray; $i++) {
            $product = new Create_product([
                'key'               => $ID,
                'productname'       => $request->input('productname')[$i],
                'productnumber'     => $request->input('productnumber')[$i],
                'unit'              => $request->input('unit')[$i]
            ]);
            $product->save();
        }

        $name = Auth::user()->username;
        $arr = new PR_create([
            'key'               => $ID,
            'date'              => $request->input('date'),
            'contractor'        => $name,
            'formwork'          => $request->input('formwork'),
            'prequestconvert'   => $request->input('prequestconvert'),
            'status'            => "active",

        ]);

        $input = [
            'key' => $ID
        ];

        $this->insertlog('CREATE', 'p_r_creates', $input);
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
        $number = 1;
        $pr_product = Create_product::all()->toArray();
        $pr_create = PR_create::find($id);
        $contractor = Auth::user()->where('username', $pr_create['contractor'])->get();
        $pr_products = Create_product::where('key', '=', $pr_create['key'])->get();
        return view('pr_create.show', compact('pr_create', 'pr_products', 'number', 'contractor', 'id'));
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

    public function insertlog($action, $table, $data)
    {
        Log::create([
            'username' => Auth::user()->username, 'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
        ]);
    }
}
