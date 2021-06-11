<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "dashboard" middleware group. Now create something great!
|
*/

// Dashboard
Route::namespace('Dashboard')->group(function(){

    // dashboard router
    Route::get('/', 'DashboardController@index')->name('dashboard-home');

    // product router
    Route::group([
        'prefix' => 'products',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'ProductController@index')->name('product-list');
        Route::get('/create', 'ProductController@create')->name('product-add');
        Route::get('{id}/detail', 'ProductController@show')->name('product-detail');
        Route::get('{id}/edit', 'ProductController@edit');
        Route::post('/create', 'ProductController@store');
        Route::patch('{id}/edit', 'ProductController@update')->name('product-update');
        Route::delete('{id}', 'ProductController@destroy')->name('product-delete'); 
        // product and category relation methods
        Route::get('/{categoryId}', 'ProductController@categoryProductsIndex')->name('category-products-list');
    });

    // product variant router
    Route::group([
        'prefix' => 'productvariants',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'ProductVariantController@index')->name('productvariant-list');
        Route::get('{productId}/create', 'ProductVariantController@create')->name('productvariant-add');
        Route::get('{id}/detail', 'ProductVariantController@show')->name('productvariant-detail');
        Route::get('{productId}/edit', 'ProductVariantController@edit')->name('productvariant-edit');
        Route::post('/create', 'ProductVariantController@store');
        Route::patch('{productId}/edit', 'ProductVariantController@update')->name('productvariant-update');
        Route::delete('{id}', 'ProductVariantController@destroy')->name('productvariant-delete'); 
        // product variant and product relation methods
        Route::get('/{productId}', 'ProductVariantController@productVariantsIndex')->name('product-productvariants-list');
    });

    // type [attributes]
    Route::group([
        'prefix' => 'types',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'TypeController@index')->name('type-list');
        Route::get('/create', 'TypeController@create')->name('type-add');
        Route::get('{id}/detail', 'TypeController@show')->name('type-detail');
        Route::get('{id}/edit', 'TypeController@edit');
        Route::post('/create', 'TypeController@store');
        Route::patch('{id}/edit', 'TypeController@update')->name('type-update');
        Route::delete('{id}', 'TypeController@destroy')->name('type-delete');        
    });

    // size [attributes]
    Route::group([
        'prefix' => 'sizes',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'SizeController@index')->name('size-list');
        Route::get('/create', 'SizeController@create')->name('size-add');
        Route::get('{id}/detail', 'SizeController@show')->name('size-detail');
        Route::get('{id}/edit', 'SizeController@edit');
        Route::post('/create', 'SizeController@store');
        Route::patch('{id}/edit', 'SizeController@update')->name('size-update');
        Route::delete('{id}', 'SizeController@destroy')->name('size-delete');        
    });

    // invoice router
    Route::group([
        'prefix' => 'invoices',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'InvoiceController@index')->name('invoice-list');
        Route::get('/create', 'InvoiceController@create')->name('invoice-add');
        Route::get('{id}/detail', 'InvoiceController@show')->name('invoice-detail');
        Route::get('{id}/edit', 'InvoiceController@edit');
        Route::post('/create', 'InvoiceController@store');
        Route::patch('{id}/edit', 'InvoiceController@update')->name('invoice-update');
        Route::delete('{id}', 'InvoiceController@destroy')->name('invoice-delete');        
    });

    // order router
    Route::group([
        'prefix' => 'orders',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'OrderController@index')->name('order-list');
        Route::get('/create', 'OrderController@create')->name('order-add');
        Route::get('{id}/detail', 'OrderController@show')->name('order-detail');
        Route::get('{id}/edit', 'OrderController@edit');
        Route::post('/create', 'OrderController@store');
        Route::patch('{id}/edit', 'OrderController@update')->name('order-update');
        Route::delete('{id}', 'OrderController@destroy')->name('order-delete');        
    });
    
    // currency router [system settings]
    Route::group([
        'prefix' => 'currencies',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'CurrencyController@index')->name('currency-list');
        Route::get('/create', 'CurrencyController@create')->name('currency-add');
        Route::get('{id}/detail', 'CurrencyController@show')->name('currency-detail');
        Route::get('{id}/edit', 'CurrencyController@edit');
        Route::post('/create', 'CurrencyController@store');
        Route::patch('{id}/edit', 'CurrencyController@update')->name('currency-update');
        Route::delete('{id}', 'CurrencyController@destroy')->name('currency-delete');        
    });

    // sugar-level router [system settings]
    Route::group([
        'prefix' => 'sugarlevels',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'SugarLevelController@index')->name('sugar-level-list');
        Route::get('/create', 'SugarLevelController@create')->name('sugar-level-add');
        Route::get('{id}/detail', 'SugarLevelController@show')->name('sugar-level-detail');
        Route::get('{id}/edit', 'SugarLevelController@edit');
        Route::post('/create', 'SugarLevelController@store');
        Route::patch('{id}/edit', 'SugarLevelController@update')->name('sugar-level-update');
        Route::delete('{id}', 'SugarLevelController@destroy')->name('sugar-level-delete');        
    });

    // category router [system settings]
    Route::group([
        'prefix' => 'categories',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'CategoryController@index')->name('category-list');
        Route::get('/create', 'CategoryController@create')->name('category-add');
        Route::get('{id}/detail', 'CategoryController@show')->name('category-detail');
        Route::get('{id}/edit', 'CategoryController@edit');
        Route::post('/create', 'CategoryController@store');
        Route::patch('{id}/edit', 'CategoryController@update')->name('category-update');
        Route::delete('{id}', 'CategoryController@destroy')->name('category-delete');        
    });

    // customer router [system settings]
    Route::group([
        'prefix' => 'customers',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'CustomerController@index')->name('customer-list');
        Route::get('/create', 'CustomerController@create')->name('customer-add');
        Route::get('{id}/detail', 'CustomerController@show')->name('customer-detail');
        Route::get('{id}/edit', 'CustomerController@edit');
        Route::post('/create', 'CustomerController@store');
        Route::patch('{id}/edit', 'CustomerController@update')->name('customer-update');
        Route::delete('{id}', 'CustomerController@destroy')->name('customer-delete');        
    });

    // user router [system settings / system users]
    Route::group([
        'prefix' => 'users',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'UserController@index')->name('user-list');
        Route::get('/create', 'UserController@create')->name('user-add');
        Route::get('{id}/detail', 'UserController@show')->name('user-detail');
        Route::get('{id}/edit', 'UserController@edit');
        Route::post('/create', 'UserController@store');
        Route::patch('{id}/edit', 'UserController@update')->name('user-update');
        Route::delete('{id}', 'UserController@destroy')->name('user-delete');        
    });

    // staff router [system settings / system users]
    Route::group([
        'prefix' => 'staffs',
        'middleware' => 'admin',
    ], function(){
        Route::get('/', 'StaffController@index')->name('staff-list');
        Route::get('/create', 'StaffController@create')->name('staff-add');
        Route::get('{id}/detail', 'StaffController@show')->name('staff-detail');
        Route::get('{id}/edit', 'StaffController@edit');
        Route::post('/create', 'StaffController@store');
        Route::patch('{id}/edit', 'StaffController@update')->name('staff-update');
        Route::delete('{id}', 'StaffController@destroy')->name('staff-delete');        
    });

});

?>
