<?php

use Illuminate\Support\Facades\Route;

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


Route::namespace('Pos')->group(function(){
    // pos router
    Route::get('/', 'PosController@index')->name('pos-home');

    // order router
    Route::post('/order', 'OrderController@store')->name('pos-order');
    
    // Receipt router
    Route::get('/receipt/{orderId}', 'OrderController@showReceipt')->name('order-receipt');

});