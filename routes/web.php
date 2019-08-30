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


Route::resource('store', 'StoreController')->middleware('123');
//Route ::resource('store','FillinformationController');
Route::resource('transform', 'TransformController')->middleware('123');
//Route ::resource('fillinformation','StoreController');
<<<<<<< HEAD
Route ::resource('prequest','PuchaserequestController')->middleware('123');
Route ::resource('porder','PurchaseorderController')->middleware('123');
Route ::resource('check','CheckController')->middleware('123');
Route ::resource('usermanage','UsermanageController')->middleware('123');
Route ::resource('pr_create','pr_createController')->middleware('123');
Route ::resource('Product', 'ProductController')->middleware('123');
Route ::resource('Product_Price', 'ProductPriceController')->middleware('123');
Route ::resource('profile','profileController')->middleware('123');
Route ::resource('Authorized_person1', 'Person1Controller')->middleware('123');
=======
Route ::resource('prequest','PuchaserequestController');
Route ::resource('porder','PurchaseorderController');
Route ::resource('check','CheckController');
Route ::resource('usermanage','UsermanageController');
Route ::resource('pr_create','pr_createController');
Route ::resource('Product', 'ProductController');
Route ::resource('Product_Price', 'ProductPriceController');
Route ::resource('profile','profileController');
Route ::resource('Authorized_person1', 'masteroneController');
Route ::resource('Authorized_person2', 'mastertwoController');
>>>>>>> 6d64ecb8dc5f8df584a565a417c6c8adc78c368a

// Sent by Ajax

Route::post('prequest/index', 'PuchaserequestController@store');
Route::post('pr_create/index','pr_createController@store');
//Route::post('prequest/index', 'PuchaserequestController@update');
Auth::routes();
Route::get('logout','masterController@logout');
Route::get('/home', 'HomeController@index')->name('home');


