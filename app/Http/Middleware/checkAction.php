<?php

namespace App\Http\Middleware;

use Closure;
use App\log;
use App\Store;
use App\product_main;
use Auth;

class checkAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $method = explode('\\', $request->route()->getActionName());
        $data = $method[count($method) - 1];
        $path = $request->route()->getActionName();
        if ($data == 'StoreController@store') {
            $arr = [
                'username' => Auth::user()->username, 'data' => $path . ';CREATE ร้านค้า ;รหัสร้านค้า:' . $request->keystore . '&ชื่อร้านค้า:' .
                    $request->name . '&ที่อยู่:' . $request->address . '&โทรศัพท์:' . $request->phone . '&fax:' .
                    $request->fax . '&ผู้ติดต่อ:' . $request->contect . '&เบอร์โทร:' . $request->cellphone
            ];
            log::create($arr);
        } else if ($data == 'StoreController@update') {
            $store = Store::find($request->store_id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => $path . ';UPDATE ร้านค้า '
            ];
            if ($store->keystore != $request->keystore) {
                $arr['data'] = $arr['data'] . ';รหัสร้านค้า(' . $store->keystore . '=>' . $request->keystore . ')';
            }
            if ($store['name'] != $request->name) {
                $arr['data'] = $arr['data'] . ';ชื่อร้านค้า(' . $store->name . '=>' . $request->name . ')';
            }
            if ($store['address'] != $request->address) {
                $arr['data'] = $arr['data'] . ';ที่อยู่ร้านค้า(' . $store->address . '=>' . $request->address . ')';
            }
            if ($store['phone'] != $request->phone) {
                $arr['data'] = $arr['data'] . ';โทรศัพท์ร้านค้า(' . $store->phone . '=>' . $request->phone . ')';
            }
            if ($store['fax'] != $request->fax) {
                $arr['data'] = $arr['data'] . ';fax(' . $store->fax . '=>' . $request->fax . ')';
            }
            if ($store['contect'] != $request->contect) {
                $arr['data'] = $arr['data'] . ';ผู้ติดต่อ(' . $store->contect . '=>' . $request->contect . ')';
            }
            if ($store['cellphone'] != $request->cellphone) {
                $arr['data'] = $arr['data'] . ';เบอร์โทร(' . $store->cellphone . '=>' . $request->cellphone . ')';
            }

            log::create($arr);
        } else if ($data == 'storeController@destroy') {
            $arr = [
                'username' => Auth::user()->username, 'data' => $path . ';DELETE ร้านค้า ;รหัสร้านค้า:' . $request->keystore
            ];
            log::create($arr);
        } else if ($data == 'ProductController@store') {
            $arr = [
                'username' => Auth::user()->username, 'data' => $path . ';CREATE สินค้า ;รหัสสินค้า:' . $request->Product_ID .
                    ';ชื่อสินค้า:' . $request->Product_name . ';unit:' . $request->unit
            ];
            log::create($arr);
        } else if ($data == 'ProductController@update') {
            $store = Product::find($request->store_id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => $path . ';UPDATE สินค้า '
            ];
            if ($store->keystore != $request->keystore) {
                $arr['data'] = $arr['data'] . ';รหัสร้านค้า(' . $store->keystore . '=>' . $request->keystore . ')';
            }
        } else if ($data == 'ProductController@destroy') { } else if ($data == 'ProductPriceController@store') { } else if ($data == 'ProductPriceController@update') { } else if ($data == 'ProductPriceController@destroy') { } else if ($data == 'pr_createController@store') { } else if ($data == 'pr_createController@update') { } else if ($data == 'pr_createController@destroy') { } else if ($data == 'PuchaserequestController@store') { } else if ($data == 'PuchaserequestController@update') { } else if ($data == 'PuchaserequestController@destroy') { } else if ($data == 'PurchaseorderController@store') { } else if ($data == 'usermanageController@store') { } else if ($data == 'usermanageController@update') { } else if ($data == 'usermanageController@destroy') { } else if ($data == 'profileController@update') { }
        return $next($request);
    }
}
