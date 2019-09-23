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

Route::group(['middleware' => ['123','checkAction']], function () {
    //Route ::resource('store','FillinformationController');
    //Route ::resource('fillinformation','StoreController');
    Route::post('profile/passcode', 'profileController@passcode');
    Route::post('prequest/closePR', 'PuchaserequestController@closePR');
    Route::post('porder/makepdf', 'purchaseorderController@makepdf');
    Route::post('prequest/makepdf', 'PuchaserequestController@makepdf');
    Route::post('pr_create/makepdf', 'pr_createController@makepdf');
    Route::post('profile/changpassword', 'profileController@changepassword');
    Route::post('usermanage/checkemail', 'UsermanageController@checkemail');
    Route::post('Product_Price/deletename', 'ProductPriceController@deletename');
    Route::resources([
        'store' => 'StoreController',
        'transform' => 'TransformController',
        'prequest' => 'PuchaserequestController',
        'porder' => 'PurchaseorderController',
        'check' => 'CheckController',
        'usermanage' => 'UsermanageController',
        'pr_create' => 'pr_createController',
        'Product' => 'ProductController',
        'Product_Price' => 'ProductPriceController',
        'profile' => 'profileController',
        'Authorized_person1' => 'masteroneController',
        'Authorized_person2' => 'mastertwoController'
    ]);
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
