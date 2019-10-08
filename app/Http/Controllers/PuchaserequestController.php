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
use App\role;
use App\mycompany;
use Barryvdh\DomPDF\PDF;

use function GuzzleHttp\Psr7\str;

class PuchaserequestController extends Controller
{


  public function closePR(Request $request)
  {
    PR_create::where('key', $request->pr)
      ->update(['status' => 'Rejected']);
    return redirect()->route('prequest.index')->with('status', 'ยกเลิกใบขอสั่งซื้อเรียบร้อยแล้ว');
  }

  public function makepdf(Request $request)
  {
    $stylesheet = file_get_contents(__DIR__ . '\style.css');
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => [210, 297],
      'default_font_size' => 14,
      'default_font' => 'thsarabunnew'
    ]);
    $key = $request->keyPR;
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

        $Rejected = pr_create::where('key', $pr_create[$i]['key'])->get('status')->toArray();
        $master1 = Authorized_person1::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
        $master2 = Authorized_person2::where('keyPR', $pr_create[$i]["key"])->get()->toArray();
        if ($Rejected[0]['status'] === "active") {
          if (empty($check)) {
            $status = "รอการตรวจสอบ";
          } elseif ($keypr != NULL && empty($master1) && empty($master2)) {
            $status = "อยู่ระหว่างดำเนินการ";
          } elseif ($keypr != NULL && $master1 != NULL && empty($master2)) {
            $status = "อยู่ระหว่างดำเนินการ";
          } elseif ($keypr != NULL && $master1 != NULL && $master2 != NULL) {
            $status = "เสร็จสมบูรณ์";
          }
        } else {
          $status = "ถูกยกเลิก";
        }

        $PR_create[] = [
          $pr_create[$i]['id'],
          $pr_create[$i]['key'],
          $pr_create[$i]['date'],
          $pr_create[$i]['contractor'],
          $pr_create[$i]['formwork'],
          $pr_create[$i]['prequestconvert'],
          $status,
          $check,
          $Rejected
        ];
      }

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


  public function getprice(Request $request)
  {
    $price = product_Price::where('Store', $request->store_id)
      ->where('Product', $request->product_id)->get()->first();
    return response()->json(['msg' => $price->Price]);
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
    $pr_store = pr_store::where('keyPR', $id)->get()->toArray();
    $db = Create_product::get()->toArray();
    $pr_create = PR_create::where('key', $id)->get()->toArray();
    $productdb = Create_product::where('key', $pr_create[0]['key'])->get()->toArray();
    $store_master = store::where('keystore', "master")->get()->toArray();
    $sum_price = $this->sum_price($pr_store[0]['sumofprice']);
    $tax = $this->tax($sum_price, $pr_store[0]['sumofprice']);
    $letter_sumofprice = $this->bathformat($pr_store[0]['sumofprice']);
    $store_mine = mycompany::where('name', "บริษัท ธีร่า แอสเสท จำกัด")->get();
    $date_master1 = $this->time_master1($pr_create[0]['key']);
    $date_master2 = $this->time_master2($pr_create[0]['key']);
    $contractor = Auth::user()->where('username', $pr_create[0]['contractor'])->get();
    $master1 = Auth::user()->where('role', '3')->get();
    $Purchasing = Auth::user()->where('role', '2')->get();
    $role_purchasing = role::where('id_role', $Purchasing[0]['role'])->get();
    $role_master1 = role::where('id_role', $master1[0]['role'])->get();
    $role_contractor = role::where('id_role', $contractor[0]['role'])->get();
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
      'pr_store',
      'contractor',
      'master1',
      'Purchasing',
      'date_master1',
      'date_master2',
      'role_purchasing',
      'role_master1',
      'role_contractor'
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
    $productdb = Create_product::where('key', $pr_create['key'])->get('productname')->toArray();
    $lengtharray = sizeof($productdb);
    $product_number = Create_product::where('key', $pr_create['key'])->get()->toArray();
    for ($i = 0; $i < $lengtharray; $i++) {
      $product_id = product_main::where('product_name', $productdb[$i])->get()->toArray();
      $product_min_price[] = product_main::where('Product_name', $productdb[$i])
        ->join('product__Prices', 'product_mains.Product_ID', 'product__Prices.Product')
        ->join('stores', 'product__Prices.Store', 'stores.keystore')
        ->orderBy('product__Prices.Price', 'asc')
        ->get()->toArray();
      $length = sizeof($product_min_price[0]);
      $cal = number_format($product_number[$i]['productnumber'] *  $product_min_price[$i][0]['Price'], 2, '.', '');
      $min[] = [
        $product_min_price[$i][0]['Product_name'],
        $product_number[$i]['productnumber'],
        $product_min_price[$i][0]['unit'],
        $product_min_price[$i],
        $product_min_price[$i][0]['Price'],
        $product_min_price[$i][0]['Product_ID'],
        $cal
      ];
      $sum += $cal;
    }

    $sumde = number_format($sum, 2);

    return view('prequest.edit', compact(
      'number',
      'pr_create',
      'min',
      'id',
      'sumde'
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
    $store = $request->keystore;
    $sumprice = $request->sumofprice;
    $lengtharray = sizeof($request->get('Product_name'));
    for ($i = 0; $i < $lengtharray; $i++) {
      $data = explode(":", $store[$i]);

      // In case change price for updating time ( products )
      
      $product_price = product_Price::where('Store', $data[0])
        ->where('Product', $data[1]);
      $check_price = $product_price->get()->first()->Price;
      if( $check_price != $request->store_price[$i] ){
        $product_price->update(['Price' => $request->store_price[$i],'updated_product' => date('Y-m-d 00:00:00') ]);
      }

      // End 
        
      $Product_pr = new Product([
        'keyPR'             => $request->get('keyPR'),
        'Product_name'      => $request->get('Product_name')[$i],
        'Product_number'    => $request->get('Product_number')[$i],
        'Store'             => $data[2],
        'Price'             => $request->store_price[$i],
        'unit'              => $request->unit[$i],
        'Product_sum'       => $request->store_sumprice[$i],
        'sumallprice'       => $sumprice,

      ]);
      $Product_pr->save();
    }
    $prequest = new prequest([
      'keyPR'             => $request->get('keyPR'),
      'date'              => $request->get('date'),
      'formwork'          => $request->get('formwork'),
      'prequestconvert'   => $request->get('prequestconvert'),
      'sumofprice'        => $request->sumofprice,

    ]);

    $input = [
      'keyPR' => $request->get('keyPR')
    ];
    $this->insertlog('CONFIRM', 'p_r_creates', $input);
    $prequest->save();
    return redirect()->route('prequest.index')->with('success', 'เรียบร้อยแล้ว');
  }

  public function info($id)
  {
    $pr_create = PR_create::where('key', $id)->get()->first();
    $product = product::where('keyPR', $id)->get();
    return view('prequest.viewinfo', compact('product', 'pr_create'));
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
    $prequestdb = prequest::find($id);
    $prequestdb->delete();
    return redirect()->route('prequest.index')->with('success', 'ลบข้อมูลเรียบร้อย');
  }

  public function insertlog($action, $table, $data)
  {
    Log::create([
      'username' => Auth::user()->username, 'role' => Auth::user()->role, 'data' => serialize($data), 'table' => $table, 'action' => $action
    ]);
  }
}
