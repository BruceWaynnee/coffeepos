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
    Route::get('/login', 'LoginController@showDashboardLogin')->name('dashboard-login');
    
    Route::post('/login', 'LoginController@dashboardLogin')->middleware('guest')->name('login');

    Route::post('/logout', 'LoginController@destroy')->middleware('auth')->name('logout');
});

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
Route::middleware('auth')->namespace('Dashboard')->group(function(){

    // dashboard router
    Route::get('/', 'DashboardController@index')->name('dashboard-home');

    // product router
        Route::group([
            'prefix' => 'products',
        ], function(){
            Route::get('/', 'ProductController@index')->name('product-list')->middleware('permission:view product');
            Route::get('/create', 'ProductController@create')->name('product-add')->middleware('permission:create product');
            Route::get('{id}/detail', 'ProductController@show')->name('product-detail')->middleware('permission:view product|create-product|edit-product');
            Route::get('{id}/edit', 'ProductController@edit')->middleware('permission:edit product');
            Route::post('/create', 'ProductController@store')->middleware('permission:create product');
            Route::patch('{id}/edit', 'ProductController@update')->name('product-update')->middleware('permission:edit product');
            Route::delete('{id}', 'ProductController@destroy')->name('product-delete')->middleware('permission:delete product'); 
            // product and category relation methods
            Route::get('/{categoryId}', 'ProductController@categoryProductsIndex')->name('category-products-list')->middleware('permission:view product');
        });

    // product variant router
        Route::group([
            'prefix' => 'productvariants',
        ], function(){
            Route::get('/', 'ProductVariantController@index')->name('productvariant-list')->middleware('permission:view product-variant');
            Route::get('{productId}/create', 'ProductVariantController@create')->name('productvariant-add')->middleware('permission:create product-variant');
            Route::get('{id}/detail', 'ProductVariantController@show')->name('productvariant-detail')->middleware('permission:view product-variant|create-product-variant|edit-product-variant');
            Route::get('{productId}/edit', 'ProductVariantController@edit')->name('productvariant-edit')->middleware('permission:edit product-variant');
            Route::post('/create', 'ProductVariantController@store')->middleware('permission:create product-variant');
            Route::patch('{productId}/edit', 'ProductVariantController@update')->name('productvariant-update')->middleware('permission:edit product-variant');
            Route::delete('{id}', 'ProductVariantController@destroy')->name('productvariant-delete')->middleware('permission:delete product-variant');
            // product variant and product relation methods
            Route::get('/{productId}', 'ProductVariantController@productVariantsIndex')->name('product-productvariants-list')->middleware('permission:view product-variant');
        });

    // type [attributes]
        Route::group([
            'prefix' => 'types',
        ], function(){
            Route::get('/', 'TypeController@index')->name('type-list')->middleware('permission:view product-type');
            Route::get('/create', 'TypeController@create')->name('type-add')->middleware('permission:create product-type');
            Route::get('{id}/detail', 'TypeController@show')->name('type-detail')->middleware('permission:view product-type|create-product-type|edit-product-type');
            Route::get('{id}/edit', 'TypeController@edit')->middleware('permission:edit product-type');
            Route::post('/create', 'TypeController@store')->middleware('permission:create product-type');
            Route::patch('{id}/edit', 'TypeController@update')->name('type-update')->middleware('permission:edit product-type');
            Route::delete('{id}', 'TypeController@destroy')->name('type-delete')->middleware('permission:delete product-type');
        });

    // size [attributes]
        Route::group([
            'prefix' => 'sizes',
        ], function(){
            Route::get('/', 'SizeController@index')->name('size-list')->middleware('permission:view product-size');
            Route::get('/create', 'SizeController@create')->name('size-add')->middleware('permission:create product-size');
            Route::get('{id}/detail', 'SizeController@show')->name('size-detail')->middleware('permission:view product-size|create-product-size|edit-product-size');
            Route::get('{id}/edit', 'SizeController@edit')->middleware('permission:edit product-size');
            Route::post('/create', 'SizeController@store')->middleware('permission:create product-size');
            Route::patch('{id}/edit', 'SizeController@update')->name('size-update')->middleware('permission:edit product-size');
            Route::delete('{id}', 'SizeController@destroy')->name('size-delete')->middleware('permission:delete product-size');
        });

    // invoice router
        Route::group([
            'prefix' => 'invoices',
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
        ], function(){
            Route::get('/', 'OrderController@index')->name('order-list')->middleware('permission:view order');
            Route::get('/create', 'OrderController@create')->name('order-add');
            Route::get('{id}/detail', 'OrderController@show')->name('order-detail')->middleware('permission:view order');
            Route::get('{id}/edit', 'OrderController@edit');
            Route::post('/create', 'OrderController@store');
            Route::patch('{id}/edit', 'OrderController@update')->name('order-update');
            Route::delete('{id}', 'OrderController@destroy')->name('order-delete')->middleware('permission:delete order');
        });
    
    // currency router [system settings]
        Route::group([
            'prefix' => 'currencies',
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
        ], function(){
            Route::get('/', 'CategoryController@index')->name('category-list')->middleware('permission:view category');
            Route::get('/create', 'CategoryController@create')->name('category-add')->middleware('permission:create category');
            Route::get('{id}/detail', 'CategoryController@show')->name('category-detail')->middleware('permission:view category|create-category|edit-category');
            Route::get('{id}/edit', 'CategoryController@edit')->middleware('permission:edit category');
            Route::post('/create', 'CategoryController@store')->middleware('permission:create category');
            Route::patch('{id}/edit', 'CategoryController@update')->name('category-update')->middleware('permission:edit category');
            Route::delete('{id}', 'CategoryController@destroy')->name('category-delete')->middleware('permission:delete category');
        });

    // customer router [system settings]
        Route::group([
            'prefix' => 'customers',
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
        ], function(){
            Route::get('/', 'UserController@index')->name('user-list')->middleware('permission:view user');
            Route::get('/create', 'UserController@create')->name('user-add')->middleware('permission:create user');
            Route::get('{id}/detail', 'UserController@show')->name('user-detail')->middleware('permission:view user|create user|edit user');
            Route::get('{id}/edit', 'UserController@edit')->middleware('permission:edit user');
            Route::post('/create', 'UserController@store')->middleware('permission:create user');
            Route::patch('{id}/edit', 'UserController@update')->name('user-update')->middleware('permission:edit user');
            Route::delete('{id}', 'UserController@destroy')->name('user-delete')->middleware('permission:delete user');
        });

    // role router [system settings / system users]
    Route::group([
        'prefix' => 'roles',
    ], function(){
        Route::get('/', 'RoleController@index')->name('role-list')->middleware('permission:view role');
        Route::get('/create', 'RoleController@create')->name('role-add')->middleware('permission:create role');
        Route::get('{id}/detail', 'RoleController@show')->name('role-detail')->middleware('permission:view role|create role|edit role');
        Route::get('{id}/edit', 'RoleController@edit')->middleware('permission:edit role');
        Route::post('/create', 'RoleController@store')->middleware('permission:create role');
        Route::patch('{id}/edit', 'RoleController@update')->name('role-update')->middleware('permission:edit role');
        Route::delete('{id}', 'RoleController@destroy')->name('role-delete')->middleware('permission:delete role');
    });

});

?>
