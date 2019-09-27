<?php

use phpDocumentor\Reflection\DocBlock\Tags\Uses;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return redirect('login');
});

Route::group(['middleware' => ['123','checkAction','checkstatus']], function () {
    Route::post('/usermanage/changepassword','UsermanageController@changepassword');
    Route::get('/usermanage/{id}/changepass','UsermanageController@changepass');
    Route::get('upload_img','uploadController@index')->name('upload_img');
    Route::post('upload_img','uploadController@store');
    //Route ::resource('store','FillinformationController');
    //Route ::resource('fillinformation','StoreController');
    Route::post('transform/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('Product/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('Product_Price/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('store/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('usermanage/activeUser','usermanageController@activeUser');
    Route::post('prequest/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('Authorized_person1/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('Authorized_person2/{id}/checkpasscode', 'checkpasscodeController@checkcode');
    Route::post('profile/passwordcheck', 'profileController@passwordcheck');
    Route::post('profile/passcode', 'profileController@insertpass');
    Route::post('prequest/closePR', 'PuchaserequestController@closePR');
    Route::post('porder/makepdf', 'purchaseorderController@makepdf');
    Route::post('prequest/makepdf', 'PuchaserequestController@makepdf');
    Route::post('pr_create/makepdf', 'pr_createController@makepdf');
    Route::post('profile/changpassword', 'profileController@changepassword');
    Route::post('usermanage/checkemail', 'UsermanageController@checkemail');
    Route::post('Product_Price/deletename', 'ProductPriceController@deletename');
    Route::group(['middleware' => 'checkstart'],function(){
        Route::resource('store', 'StoreController');
        Route::resource('transform', 'TransformController');
        Route::resource('prequest', 'PuchaserequestController');
        Route::resource('porder', 'PurchaseorderController');
        Route::resource('check', 'CheckController');
        Route::resource('pr_create', 'pr_createController');
        Route::resource('Product', 'ProductController');
        Route::resource('Product_Price', 'ProductPriceController');
        Route::resource('Authorized_person1', 'masteroneController');
        Route::resource('Authorized_person2', 'mastertwoController');
        Route::resource('usermanage', 'UsermanageController');
    });
    Route::resource('profile', 'profileController');

    // Sent by Ajax
    Route::post('profile/viewSignature', 'profileController@viewSignature');
    Route::post('profile/createSignature', 'profileController@createSignature');
    Route::post('prequest/index', 'PuchaserequestController@store');
    Route::post('pr_create/index', 'pr_createController@store');
    //Route::post('prequest/index', 'PuchaserequestController@update');
    Route::get('logout', 'masterController@logout');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
