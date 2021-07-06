<?php

use Illuminate\Support\Facades\Route;

/*
 | #####################
 |    Authentication
 | #####################
 |
 | Here is where you register all dashboard authentication routers.
 | 
 */
Route::namespace('Auth')->group(function(){
    Route::get('/systemopen', 'PosLoginController@showPosLogin')->name('pos-login');

    Route::post('/systemlogin', 'PosLoginController@posLogin')->middleware('guest')->name('open-pos');

    Route::post('/systemlogout', 'PosLoginController@posDestroy')->middleware('auth')->name('close-pos');
});

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


Route::middleware('pos_auth')->namespace('Pos')->group(function(){
    // pos router    
    Route::get('/', 'PosController@index')->name('pos-home');

    // order router
    Route::post('/order', 'OrderController@store')->name('pos-order');
    
    // Receipt router
    Route::get('/receipt/{orderId}', 'OrderController@showReceipt')->name('order-receipt');

});