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

Route::post('store/posttopdf','StoreController@filetopdf');
Route::resource('store', 'StoreController');
//Route ::resource('store','FillinformationController');
Route::resource('transform', 'TransformController');
//Route ::resource('fillinformation','StoreController');
Route::post('prequest/filetopdf', 'PuchaserequestController@filetopdf');
Route ::resource('prequest','PuchaserequestController');
Route ::resource('porder','PurchaseorderController');
Route ::resource('check','CheckController');
Route ::resource('usermanage','UsermanageController');


// Sent by Ajax

Route::post('prequest/index', 'PuchaserequestController@store');

//Route::post('prequest/index', 'PuchaserequestController@update');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
