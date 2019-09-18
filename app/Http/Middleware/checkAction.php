<?php

namespace App\Http\Middleware;

use Closure;
use App\log;
use App\Store;
use App\User;
use App\product_main;
use Auth;
use App\Transform;



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
                'username' => Auth::user()->username, 'data' => 'CREATE ร้านค้า ;รหัสร้านค้า:' . $request->keystore . '&ชื่อร้านค้า:' .
                    $request->name . '&ที่อยู่:' . $request->address . '&โทรศัพท์:' . $request->phone . '&fax:' .
                    $request->fax . '&ผู้ติดต่อ:' . $request->contect . '&เบอร์โทร:' . $request->cellphone,
                'action' => $path
            ];
            log::create($arr);
        } else if ($data == 'StoreController@update') {
            $store = Store::find($request->store_id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => 'UPDATE ร้านค้า ',
                'action' => $path
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
        } else if ($data == 'StoreController@destroy') {
            $arr = [
                'username' => Auth::user()->username, 'data' => 'DELETE ร้านค้า ;รหัสร้านค้า:' . $request->keystore,
                'action' => $path
            ];
            log::create($arr);
        } else if ($data == 'ProductController@store') {
            $arr = [
                'username' => Auth::user()->username, 'data' => 'CREATE สินค้า ;รหัสสินค้า:' . $request->Product_ID .
                    ';ชื่อสินค้า:' . $request->Product_name . ';หน่วย:' . $request->unit,
                'action' => $path
            ];
            log::create($arr);
        } else if ($data == 'ProductController@update') {
            $product = product_main::find($request->product_id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => 'UPDATE สินค้า ',
                'action' => $path
            ];

            if ($product->Product_ID != $request->Product_ID) {
                $arr['data'] = $arr['data'] . ';รหัสสินค้า(' . $product->Product_ID . '=>' . $request->Product_ID . ')';
            }
            if ($product->Product_name != $request->Product_name) {
                $arr['data'] = $arr['data'] . ';ชื่อสินค้า(' . $product->Product_name . '=>' . $request->Product_name . ')';
            }
            if ($product->unit != $request->unit) {
                $arr['data'] = $arr['data'] . ';หน่วย(' . $product->unit . '=>' . $request->unit . ')';
            }
            log::create($arr);
        } else if ($data == 'ProductController@destroy') {
            $arr = [
                'username' => Auth::user()->username, 'data' => 'DELETE สินค้า ;รหัสสินค้า:' . $request->Product_ID,
                'action' => $path
            ];
            log::create($arr);
        } else if ($data == 'ProductPriceController@store') {
           
        } else if ($data == 'ProductPriceController@update') { 

        } else if ($data == 'ProductPriceController@destroy') {
            
        } else if ($data == 'PuchaserequestController@update') { 

        } else if ($data == 'UsermanageController@store') {
            $arr = [
                'username' => Auth::user()->username, 'data' => 'CREATE userid ;ชื่อจริง:' . $request->firstname . '&นามสกุล:' .
                    $request->lastname . '&ที่อยู่:' . $request->address . '&โทรศัพท์:' . $request->phone . '&อีเมล:' .
                    $request->email . '&username:' . $request->username . '&role:' . $request->role,
                'action' => $path
            ];
            log::create($arr);
        } else if ($data == 'UsermanageController@update') {
            $user = User::find($request->id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => 'UPDATE ผู้ใช้งาน ',
                'action' => $path
            ];

            $arr['data'] = $arr['data'] . ';username:' . $user->username;

            if ($user->firstname != $request->firstname) {
                $arr['data'] = $arr['data'] . ';ชื่อจริง(' . $user->firstname . '=>' . $request->firstname . ')';
            }
            if ($user->lastname != $request->lastname) {
                $arr['data'] = $arr['data'] . ';นามสกุล(' . $user->lastname . '=>' . $request->lastname . ')';
            }
            if ($user->address != $request->address) {
                $arr['data'] = $arr['data'] . ';ที่อยู่(' . $user->address . '=>' . $request->address . ')';
            }
            if ($user->phone != $request->phone) {
                $arr['data'] = $arr['data'] . ';เบอร์โทรศัพท์(' . $user->phone . '=>' . $request->phone . ')';
            }
            if ($user->email != $request->email) {
                $arr['data'] = $arr['data'] . ';อีเมล(' . $user->email . '=>' . $request->email . ')';
            }
            if ($user->role != $request->role) {
                $arr['data'] = $arr['data'] . ';ตำแหน่ง(' . $user->role . '=>' . $request->role . ')';
            }
            log::create($arr);
        } else if ($data == 'UsermanageController@destroy') {
            $arr = [
                'username' => Auth::user()->username, 'data' => 'DELETE userid ;usename:' . $request->username,
                'action' => $path
            ];
            log::create($arr);
        } 
        else if( $data == 'TransformController@store'  ){
            $arr = [
                'username' => Auth::user()->username, 'data' => 'CREATE แปลง ;ชื่อแปลง:' . $request->convertname . '&ขนาด:'.$request->size ,
                'action' => $path
            ];
            log::create($arr);
        }
        else if( $data == 'TransformController@update' ){
            $transform = Transform::find($request->id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => 'UPDATE แปลง ',
                'action' => $path
            ];
            if ($transform->convertname != $request->convertname) {
                $arr['data'] = $arr['data'] . ';ชื่อแปลง(' . $transform->convertname . '=>' . $request->convertname . ')';
            }
            if ($transform->size != $request->size) {
                $arr['data'] = $arr['data'] . ';ขนาด(' . $transform->size . '=>' . $request->size . ')';
            }
            log::create($arr);
        }
        else if( $data == 'TransformController@destroy' ){
            $arr = [
                'username' => Auth::user()->username, 'data' => 'DELETE แปลง ;ชื่อแปลง:' . $request->convertname,
                'action' => $path
            ];
            log::create($arr);
        }
        else if ($data == 'profileController@update') {
            $profile = User::find($request->id);
            $arr = [
                'username' => Auth::user()->username,
                'data' => 'UPDATE ผู้ใช้งาน ',
                'action' => $path
            ];

            $arr['data'] = $arr['data'] . ';username:' . $profile->username;

            if ($profile->firstname != $request->firstname) {
                $arr['data'] = $arr['data'] . ';ชื่อจริง(' . $profile->firstname . '=>' . $request->firstname . ')';
            }
            if ($profile->lastname != $request->lastname) {
                $arr['data'] = $arr['data'] . ';นามสกุล(' . $profile->lastname . '=>' . $request->lastname . ')';
            }
            if ($profile->address != $request->address) {
                $arr['data'] = $arr['data'] . ';ที่อยู่(' . $profile->address . '=>' . $request->address . ')';
            }
            if ($profile->phone != $request->phone) {
                $arr['data'] = $arr['data'] . ';เบอร์โทรศัพท์(' . $profile->phone . '=>' . $request->phone . ')';
            }
            if ($profile->email != $request->email) {
                $arr['data'] = $arr['data'] . ';อีเมล(' . $profile->email . '=>' . $request->email . ')';
            }
            log::create($arr);
        }
        return $next($request);
    }
}
