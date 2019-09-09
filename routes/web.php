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



Route::group(['middleware' => ['123','checkAction']], function () {
    //Route ::resource('store','FillinformationController');
    //Route ::resource('fillinformation','StoreController');
    Route::post('porder/makepdf', 'purchaseorderController@makepdf');
    Route::post('pr_create/makepdf', 'pr_createController@makepdf');
    Route::post('profile/changpassword', 'profileController@changepassword');
    Route::post('usermanage/checkemail', 'UsermanageController@checkemail');
    Route::resource('store', 'StoreController');
    Route::resource('transform', 'TransformController');
    Route::resource('prequest', 'PuchaserequestController');
    Route::resource('porder', 'PurchaseorderController');
    Route::resource('check', 'CheckController');
    Route::resource('usermanage', 'UsermanageController');
    Route::resource('pr_create', 'pr_createController');
    Route::resource('Product', 'ProductController');
    Route::resource('Product_Price', 'ProductPriceController');
    Route::resource('profile', 'profileController');
    Route::resource('Authorized_person1', 'masteroneController');
    Route::resource('Authorized_person2', 'mastertwoController');
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
