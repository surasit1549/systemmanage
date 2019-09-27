<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\porder;
use App\product;
use App\Store;
use App\transform;
use App\prequest;
use App\checkkeystore;
use App\Authorized_person1;
use App\Authorized_person2;
use App\pr_store;
use vendor\autoload;
use App\pr_create;
use App\log;
use Illuminate\Support\Facades\Auth;

class PurchaseorderController extends Controller
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
        
        $key = $request->keyPO;
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($request->pdf, 2);
        $mpdf->Output("pdf/PO$key.pdf", 'F');
        return response()->json(['msg' => 'Successful']);
    }


    public function index()
    {
        $number = 1;
        $data = porder::get()->toArray();
        return view('porder.index', compact('data', 'number'));
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

    function product_sum($id){
        $length = sizeof($id);
        $sum = 0;
        for($i=0; $i<$length; $i++){
            $sum = [$sum[0] + $id[$i]['product_sum']];
        }
        return $sum;
    }

    function sum_price($sumofprice)
    {
        $sum = number_format(($sumofprice * (100 / 107)), 2, '.', '');
        return $sum;
    }

    function tax($sum_price, $sumofprice)
    {
        $tax = floatval($sumofprice) - $sum_price;
        $str_tax = number_format($tax, 2, '.', '');
        return $tax;
    }

    function bathformat($number)
    {
        $numberstr = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า', 'สิบ');
        $digitstr = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');

        $number = str_replace(",", "", $number); // ลบ comma
        $number = explode(".", $number); // แยกจุดทศนิยมออก

        // เลขจำนวนเต็ม
        $strlen = strlen($number[0]);
        $result = '';
        for ($i = 0; $i < $strlen; $i++) {
            $n = substr($number[0], $i, 1);
            if ($n != 0) {
                if ($i == ($strlen - 1) and $n == 1) {
                    $result .= 'เอ็ด';
                } elseif ($i == ($strlen - 2) and $n == 2) {
                    $result .= 'ยี่';
                } elseif ($i == ($strlen - 2) and $n == 1) {
                    $result .= '';
                } else {
                    $result .= $numberstr[$n];
                }
                $result .= $digitstr[$strlen - $i - 1];
            }
        }
        $result .= 'บาทถ้วน';
        return $result;
    }

    function time_master1($id)
    {
        $master1 = Authorized_person1::where('keyPR', $id)->get('created_at');
        $datetime = substr($master1[0]['created_at'], 0, -9);
        $date = substr($datetime, 8);
        $mouth = substr($datetime, 5, -3);
        $year = substr($datetime, 0, -6);
        $date_master1 = $date . '-' . $mouth . '-' . $year;
        return $date_master1;
    }

    function time_master2($id)
    {
        $master2 = Authorized_person2::where('keyPR', $id)->get('created_at');
        $datetime = substr($master2[0]['created_at'], 0, -9);
        $date = substr($datetime, 8);
        $mouth = substr($datetime, 5, -3);
        $year = substr($datetime, 0, -6);
        $date_master2 = $date . '-' . $mouth . '-' . $year;
        return $date_master2;
    }

    public function show($id)
    {
        $number = 1;
        $po_id = porder::where('PO_ID', $id)->get()->toArray();
        $store = Store::where('name', $po_id[0]['store_ID'])->get('keystore');
        $convert = pr_create::where('key', $po_id[0]['keyPR'])->get();
        $data = pr_store::where('PO_ID', $po_id[0]['PO_ID'])->get()->toArray();
        $product_sum = $this->product_sum($data);
        $sum_price = $this->sum_price($product_sum[0]);
        $tax = $this->tax($sum_price, $product_sum[0]);
        $letter_sumofprice = $this->bathformat($product_sum[0]);
        $store = Store::where('keystore', $store[0]['keystore'])->get()->toArray();
        $store_mine = Store::where('keystore', 'master')->get();
        $date_master1 = $this->time_master1($convert[0]['key']);
        $date_master2 = $this->time_master2($convert[0]['key']);
        $contractor = Auth::user()->where('username', $convert[0]['contractor'])->get();
        $master1 = Auth::user()->where('role', '3')->get();
        $master2 = Auth::user()->where('role', '4')->get();
        return view('porder.show', compact(
            'po_id',
            'data',
            'store',
            'store_mine',
            'convert',
            'sum_price',
            'tax',
            'letter_sumofprice',
            'number',
            'contractor',
            'master1',
            'master2',
            'logo',
            'date_master1',
            'date_master2',
            'id'
        ));
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
    {
        //
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
