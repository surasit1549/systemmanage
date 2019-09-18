<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Illuminate\Support\Facades\DB;
use vendor\autoload;
use App\log;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{


  public function filetopdf(Request $request)
  {
    $mpdf = new \Mpdf\Mpdf(['default_font_size' => 16, 'default_font' => 'thsarabunnew']);
    $mpdf->WriteHTML($request->get('html'));
    $mpdf->Output();
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


  public function insertlog($action, $table, $previous_data, $new_data, $element)
  {
    Log::create([
      'username' => Auth::user()->username, 'previous_data' => $previous_data, 'new_data' => $new_data, 'element' => $element, 'table' => $table, 'action' => $action
    ]);
  }

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

    $input =       [
      'keystore'  => $request->get('keystore'),
      'name'      => $request->get('name'),
      'address'   => $request->get('address'),
      'phone'     => $request->get('phone'),
      'fax'       => $request->get('fax'),
      'contect'   => $request->get('contect'),
      'cellphone' => $request->get('cellphone')
    ];
    $store = new Store($input);
    $element =  implode(',', array_keys($input));
    $new_data =  implode(',', $input);
    $this->insertlog('CREATE','stores','-',$new_data,$element);
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
  { }

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

    $data = array();
    $old = array();
    $detailTable = Store::find($id)->get();
    if ($detailTable[0]->keystore != $request->keystore) {
      $data += ['keystore' => $request->keystore];
      $old += ['0' => $detailTable[0]->keystore];
    }
    if ($detailTable[0]->name != $request->name) {
      $data += ['name' => $request->name];
      $old += ['1' =>$detailTable[0]->name];
    }
    if ($detailTable[0]->address != $request->address) {
      $data += ['address' => $request->address];
      $old += ['2' => $detailTable[0]->address];
    }
    if ($detailTable[0]->phone != $request->phone) {
      $data += ['phone' => $request->phone];
      $old += ['3' => $detailTable[0]->phone];
    }
    if ($detailTable[0]->fax != $request->fax) {
      $data += ['fax' => $request->fax];
      $old += ['4' =>$detailTable[0]->fax];
    }
    if ($detailTable[0]->contect != $request->contect) {
      $data += ['contact' => $request->contect];
      $old += ['5' => $detailTable[0]->contect];
    }
    if ($detailTable[0]->cellphone != $request->cellphone) {
      $data += ['cellphone' => $request->cellphone];
      $old += ['6' => $detailTable[0]->cellphone];
    }

    $this->insertlog('UPDATE', 'stores', implode(',',$old), implode(',',$data) , implode(',',array_keys($data)));

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
    $this->insertlog('DELETE','stores','-', (clone $store)->get('keystore')[0]->keystore,'keystore');
    $store->delete();
    return redirect()->route('store.index')->with('success', 'ลบข้อมูลเรียบร้อย');
  }
}
