<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\prequest;
use App\transform;
use App\store;
use App\Product;
use vendor\autoload;

use App\Create_product;
use App\PR_create;
use App\product_Price;
use App\product_main;
use App\pr_store;
use App\Authorized_person1;
use App\Authorized_person2;
use App\log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF;

class PuchaserequestController extends Controller
{

  public function makepdf(Request $request)
  {
    $stylesheet = file_get_contents(__DIR__ . '\style.css');
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => [210, 297],
      'default_font_size' => 16,
      'default_font' => 'thsarabunnew'
    ]);
    $key = $request->keyPO;
    $mpdf->WriteHTML($stylesheet, 1);
    $mpdf->WriteHTML($request->pdf, 2);
    $mpdf->Output("pdf/PR$key.pdf", 'F');
    return response()->json(['msg' => 'Successful']);
  }

  public function filetopdf(Request $request)
  {

    $mpdf = new \Mpdf\Mpdf(['default_font_size' => 16, 'default_font' => 'thsarabunnew']);
    $mpdf->WriteHTML($request->get('html'));
    $mpdf->Output();
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $number = 1;
    $num = 1;
    $keypr = prequest::get()->toArray();
    $pr_create = pr_create::all()->toArray();
    if (empty($pr_create)) {
      $pr_create = '';
      $PR_creates = '';
      $status = '';
    } else {
      $lengtharray = sizeof($pr_create);
      for ($i = 0; $i < $lengtharray; $i++) {

        $check = prequest::where('keyPR', $pr_create[$i]['key'])->get()->toArray();

        $master1 = Authorized_person1::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
        $master2 = Authorized_person2::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
        if (empty($check)) {
          $status = "รอการตรวจสอบ";
        } elseif ($keypr != NULL && empty($master1) && empty($master2)) {
          $status = "อยู่ระหว่างดำเนินการ";
        } elseif ($keypr != NULL && $master1 != NULL && empty($master2)) {
          $status = "อยู่ระหว่างดำเนินการ";
        } elseif ($keypr != NULL && $master1 != NULL && $master2 != NULL) {
          $status = "เสร็จสมบูรณ์";
        }
        //dd($status);
        $PR_create[] = [
          $pr_create[$i]['id'],
          $pr_create[$i]['key'],
          $pr_create[$i]['date'],
          $pr_create[$i]['contractor'],
          $pr_create[$i]['formwork'],
          $pr_create[$i]['prequestconvert'],
          $status,
          $check

        ];
      }
      //dd($PR_create);
      $pr_num = sizeof($pr_create);
      for ($i = $pr_num - 1; $i >= 0; $i--) {
        $PR_creates[] = $PR_create[$i];
      }
    }
    return view('prequest.index', compact(
      'number',
      'PR_creates',
      'pr_create',
      'status'
    ));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('prequest.create');
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
    $pr_store = pr_store::where('keyPR', $id)->get()->toArray();
    $db = Create_product::get()->toArray();
    $pr_create = PR_create::where('key', $id)->get()->toArray();
    $productdb = Create_product::where('key', $pr_create[0]['key'])->get()->toArray();
    $store_master = store::where('keystore', "master")->get()->toArray();
    $sum_price = $this->sum_price($pr_store[0]['sumofprice']);
    $tax = $this->tax($sum_price, $pr_store[0]['sumofprice']);
    $letter_sumofprice = $this->bathformat($pr_store[0]['sumofprice']);
    $store_mine = Store::where('keystore', 'master')->get();
    //dd($pr_create);
    return view('prequest.show', compact(
      'number',
      'id',
      'productdb',
      'pr_create',
      'store_master',
      'sum_price',
      'tax',
      'letter_sumofprice',
      'store_mine',
      'pr_store'
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
    $number = 1;
    $sum = 0;
    $pr_create = PR_create::find($id)->toArray();
    //dd($pr_create['key']);
    $productdb = Create_product::where('key', $pr_create['key'])->get('productname')->toArray();
    $lengtharray = sizeof($productdb);
    for ($i = 0; $i < $lengtharray; $i++) {
      $product_id = product_main::where('product_name', $productdb[$i])->get()->toArray();
      $product_price = product_Price::where('Product', $product_id)->min('Price');
      //  ->where('Product',$product_id[0]['Product_ID'])->min('Price');
      $product_min_price[] = product_main::where('Product_name', $productdb[$i])
        ->join('product__Prices', 'product_mains.Product_ID', 'product__Prices.Product')
        ->where('Price', $product_price)
        ->get()->toArray();
      $length_stores = sizeof($product_min_price);
      $store_price[] = product_Price::where('Price', $product_price)->get('Store')->toArray();
      $product_number = Create_product::where('key', $pr_create['key'])->get()->toArray();
      $products_sum = [$product_price * $product_number[$i]['productnumber']];
      $sum = [$sum[0] + $products_sum[0]];
      $length_store[] = sizeof($store_price[$i]);
      $min[] = [
        $product_min_price[$i][0]['Product_name'],
        $product_number[$i]['productnumber'],
        $product_min_price[$i][0]['unit'],
        $product_min_price[$i],
        $product_min_price[$i][0]['Price'],
        $products_sum[0],
      ];
    }
    return view('prequest.edit', compact(
      'number',
      'pr_create',
      'min',
      'sum',
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
  public function update(Request $request, $id)
  {
    $lengtharray = sizeof($request->get('Product_name'));
    for ($i = 0; $i < $lengtharray; $i++) {
      $Product_pr = new Product([
        'keyPR'             => $request->get('keyPR'),
        'Product_name'      => $request->get('Product_name')[$i],
        'Product_number'    => $request->get('Product_number')[$i],
        'unit'              => $request->get('unit')[$i],
        'Store'             => $request->get('keystore')[$i],
        'Price'             => $request->get('price')[$i],
        'Product_sum'       => $request->get('product_sum')[$i],
        'sumallprice'       => $request->get('sum'),

      ]);
      $Product_pr->save();
    }
    $prequest = new prequest([
      'keyPR'             => $request->get('keyPR'),
      'date'              => $request->get('date'),
      'formwork'          => $request->get('formwork'),
      'prequestconvert'   => $request->get('prequestconvert'),
      'sumofprice'        => $request->get('sum'),

    ]);

    $input = [
      'keyPR' => $request->get('keyPR')
    ];
    $this->insertlog('CONFIRM', 'p_r_creates', $input);
    $prequest->save();
    return redirect()->route('prequest.index')->with('success', 'เรียบร้อยแล้ว');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $collection = collect([1, 2, 3, 4]);
    $prequestdb = prequest::where('keyPR', $id)->get();
    //dd($prequestdb);
    $filtered = $prequestdb->reject(function ($value, $key) {
      return $value['keyPR'] > 100;
    });
    $filtered->all();
    dd($filtered);
    $prequestdb = prequest::find($id);
    $prequestdb->delete();
    return redirect()->route('prequest.index')->with('success', 'ลบข้อมูลเรียบร้อย');
  }

  public function insertlog($action, $table, $data)
  {
    Log::create([
      'username' => Auth::user()->username, 'data' => serialize($data), 'table' => $table, 'action' => $action
    ]);
  }
}
