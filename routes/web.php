<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route ::resource('store','StoreController');
//Route ::resource('store','FillinformationController');
Route ::resource('transform','TransformController');
//Route ::resource('fillinformation','StoreController');
Route ::resource('prequest','PuchaserequestController');
Route ::resource('porder','puchaseorderController');