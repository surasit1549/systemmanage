<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\porder;
use App\product;
use App\Store;
use App\transform;
use App\prequest;
use App\checkkeystore;
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
        $mpdf->WriteHTML($request->pdf,2);
        $mpdf->Output("pdf/PR$key.pdf", 'F');
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

    public function show($id)
    {
        $number = 1;
        $po_id = porder::find($id);
        $convert = pr_create::where('key', $po_id['keyPR'])->get();
        $data = pr_store::where('PO_ID', $po_id['PO_ID'])->get()->toArray();
        //dd($data[0]['sumofprice']);
        $sum_price = $this->sum_price($data[0]['sumofprice']);
        $tax = $this->tax($sum_price, $data[0]['sumofprice']);
        $letter_sumofprice = $this->bathformat($data[0]['sumofprice']);
        $store = Store::where('keystore', $po_id['store_ID'])->get()->toArray();
        $store_mine = Store::where('keystore', 'master')->get();
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

    public function insertlog($action, $table, $previous_data, $new_data, $element)
    {
        Log::create([
            'username' => Auth::user()->username, 'previous_data' => $previous_data, 'new_data' => $new_data, 'element' => $element, 'table' => $table, 'action' => $action
        ]);
    }

}
