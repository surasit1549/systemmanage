<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\DB;
use vendor\autoload;

class StoreController extends Controller
{


  public function filetopdf(Request $request){
   /*  $mpdf = new \Mpdf\Mpdf(['default_font_size' => 16, 'default_font' => 'thsarabunnew']);
    $mpdf->WriteHTML($request->get('html'));
    $mpdf->Output(); */
    return response()->json(['msg','success'],200);
  }

  public function usersList()
  {
    $usersQuery = Users::query();
    $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
    $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
    if ($start_date && $end_date) {
      $start_date = date('Y-m-d', strtotime($start_date));
      $end_date = date('Y-m-d', strtotime($end_date));
      $usersQuery->whereRaw("date(users.created_at) >= '" . $start_date . "' AND date(users.created_at) <= '" . $end_date . "'");
    }
    $users = $usersQuery->select('*');
    return datatables()->of($users)->make(true);
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    /*    $store = Store::all()->toArray();
      return view('store.index',compact('store'));
 */
    $store = Store::all();
    return view('store.index', compact('store'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    
    return view('store.create');
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
      'keystore'  => 'required',
      'name'      => 'required',
      'address'   => 'required',
      'phone'     => 'required',
      'fax'       => 'required',
      'contect'   => 'required',
      'cellphone' => 'required'
    ]);
    $store = new Store(
      [
        'keystore'  => $request->get('keystore'),
        'name'      => $request->get('name'),
        'address'   => $request->get('address'),
        'phone'     => $request->get('phone'),
        'fax'       => $request->get('fax'),
        'contect'   => $request->get('contect'),
        'cellphone' => $request->get('cellphone')
      ]
    );
    $store->save();
    return redirect()->route('store.index')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $store = Store::find($id);
    //dd($store);
    return view('store.edit', compact('store', 'id'));
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
        'keystore'  => 'required',
        'name'      => 'required',
        'address'   => 'required',
        'phone'     => 'required',
        'fax'       => 'required',
        'contect'   => 'required',
        'cellphone' => 'required'
      ]
    );
    $store = Store::find($id);
    $store->keystore  = $request->get('keystore');
    $store->name      = $request->get('name');
    $store->address   = $request->get('address');
    $store->phone     = $request->get('phone');
    $store->fax       = $request->get('fax');
    $store->contect   = $request->get('contect');
    $store->cellphone = $request->get('cellphone');
    $store->save();
    return redirect()->route('store.index')->with('success', 'อัพเดทข้อมูลเรียบร้อยแล้ว');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $store = Store::find($id);
    $store->delete();
    return redirect()->route('store.index')->with('success', 'ลบข้อมูลเรียบร้อย');
  }
}
