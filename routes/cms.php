<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Cms Routes
|--------------------------------------------------------------------------
|
| Here is where you can register cms routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "cms" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {

    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            Route::get('/login', 'AdminController@login')->name('login');
            Route::post('/login', 'AdminController@doLogin')->name('do-login');
        });
    });
});

Route::middleware('auth:cms')->group(function () {
    
        Route::prefix('admin')->group(function () {

            Route::name('admin.')->group(function () {

                Route::get('/logout', 'AdminController@logout')->name('logout');
                Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
            });


            Route::prefix('products')->group(function () {
                Route::name('product.')->group(function () {
                    Route::get('/', 'ProductController@index')->name('list');
                    Route::get('/create', 'ProductController@create')->name('create');
                    Route::post('/add-new', 'ProductController@store')->name('store');
                    Route::get('/delele', 'ProductController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
                    Route::post('/edit/{id}', 'ProductController@update')->name('update');
                    Route::get('/load-ajax', 'ProductController@loadAJAX')->name('load-ajax');
                    Route::post('/load-accessories-create', 'ProductController@loadAccessoriesCreate')->name('load-accessories-create');
                    Route::get('/check-unique-code', 'ProductController@checkUnique')->name('check-unique-name');
                   
                });
            });


            Route::prefix('product-categories')->group(function () {
                Route::name('product-categories.')->group(function () {
                    Route::get('/', 'ProductCategoryController@index')->name('list');
                    Route::get('/add-new', 'ProductCategoryController@create')->name('create');
                    Route::post('/add-new', 'ProductCategoryController@store')->name('store');
                    Route::get('/delele', 'ProductCategoryController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'ProductCategoryController@edit')->name('edit');
                    Route::post('/edit/{id}', 'ProductCategoryController@update')->name('update');
                    Route::get('/load-ajax', 'ProductCategoryController@loadAJAX')->name('load-ajax');
                });
            });

            Route::prefix('accessory-categories')->group(function () {
                Route::name('accessory-category.')->group(function () {
                    Route::get('/', 'AccessoryCategoryController@index')->name('list');
                    Route::get('/add-new', 'AccessoryCategoryController@create')->name('create');
                    Route::post('/add-new', 'AccessoryCategoryController@store')->name('store');
                    Route::get('/delele', 'AccessoryCategoryController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'AccessoryCategoryController@edit')->name('edit');
                    Route::post('/edit/{id}', 'AccessoryCategoryController@update')->name('update');
                    Route::get('/load-ajax', 'AccessoryCategoryController@loadAJAX')->name('load-ajax');
                    Route::post('/load-select-accessory-category', 'AccessoryCategoryController@loadSelectAccessoryCategory')->name('load-select-accessory-category');

                });
            });

            Route::prefix('customers')->group(function(){
                Route::name('customers.')->group(function (){
                    Route::get('/','CustomerController@index')->name('list');
                    Route::get('/add-new','CustomerController@create')->name('create');
                    Route::post('/add-new','CustomerController@store')->name('store');
                    Route::get('/delete','CustomerController@destroy')->name('delete');
                    Route::get('/edit/{id}','CustomerController@edit')->name('edit');
                    Route::post('/edit/{id}','CustomerController@update')->name('update');
                    Route::get('/load-ajax','CustomerController@loadAJAX')->name('load-ajax');
                    Route::post('/reset-pasword','CustomerController@resetPassword')->name('reset-password');
                });
            });

            Route::prefix('accessories')->group(function () {
                Route::name('accessory.')->group(function () {
                    Route::get('/', 'AccessoryController@index')->name('list');
                    Route::get('/add-new', 'AccessoryController@create')->name('create');
                    Route::post('/add-new', 'AccessoryController@store')->name('store');
                    Route::get('/delete', 'AccessoryController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'AccessoryController@edit')->name('edit');
                    Route::post('/edit/{id}', 'AccessoryController@update')->name('update');
                    Route::get('/load-ajax', 'AccessoryController@loadAJAX')->name('load-ajax');
                    Route::post('/load-modal-choose-product', 'AccessoryController@loadModalChooseProduct')->name('load-modal-choose-product');
                    Route::get('/check-unique-code', 'AccessoryController@checkUnique')->name('check-unique-code');
                });
            });

            Route::post('/upload', 'DashboardController@upload_image')->name('cms.upload-image');

            Route::prefix('configs')->group(function () {
                Route::name('configs.')->group(function () {
                    Route::get('/', 'ConfigController@index')->name('list');
                    Route::post('/store', 'ConfigController@store')->name('store');
                });
            });

            Route::prefix('invoices')->group(function () {
                Route::name('invoice.')->group(function () {
                    Route::get('/', 'InvoiceController@cmsList')->name('list');
                    Route::get('/load-ajax', 'InvoiceController@loadAJAX')->name('load-ajax');
                    Route::get('/detail/{id}', 'InvoiceController@cmsDetail')->name('detail');
                    Route::post('/updateAJax', 'InvoiceController@updateAJax')->name('update-ajax');
                    Route::post('/update/{id}', 'InvoiceController@update')->name('update');
                    Route::get('/delete', 'InvoiceController@destroy')->name('delete');
                //Route::post('/store', 'ConfigController@store')->name('store');
                });
            }); 

            Route::prefix('supplier')->group(function () {
                Route::name('supplier.')->group(function () {
                    Route::get('/', 'SupplierController@index')->name('list');
                    Route::get('/add-new', 'SupplierController@create')->name('create');
                    Route::post('/add-new', 'SupplierController@store')->name('store');
                    Route::get('/delele', 'SupplierController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'SupplierController@edit')->name('edit');
                    Route::post('/edit/{id}', 'SupplierController@update')->name('update');
                    Route::get('/load-ajax', 'SupplierController@loadAJAX')->name('load-ajax');
                    Route::get('/check-unique-code', 'SupplierController@checkUnique')->name('check-unique-code');
                });
            });

            Route::prefix('goods-receipt')->group(function () {
                Route::name('goods-receipt.')->group(function () {
                    Route::get('/', 'GoodsReceiptController@index')->name('list');
                    Route::get('/add-new', 'GoodsReceiptController@create')->name('create');
                    Route::post('/add-new', 'GoodsReceiptController@store')->name('store');
                    Route::get('/delele', 'GoodsReceiptController@destroy')->name('delete');
                    Route::get('/edit/{id}', 'GoodsReceiptController@edit')->name('edit');
                    Route::post('/edit/{id}', 'GoodsReceiptController@update')->name('update');
                    Route::get('/load-ajax', 'GoodsReceiptController@loadAJAX')->name('load-ajax');
                    Route::get('/load-ajax-accessories', 'GoodsReceiptController@loadAJAXSearchAccessories')->name('load-ajax-accessories');
                    Route::post('/load-ajax-get-accessory', 'GoodsReceiptController@getAccessoryAjax')->name('get-accessory');
                    Route::get('/load-ajax-get-supplier-code', 'GoodsReceiptController@getSupplierCodeAjax')->name('get-supplier-code');
                    
                });
            });

            Route::prefix('statistic')->group(function () {
                Route::name('statistic.')->group(function () {
                    Route::get('/', 'StatisticController@accessoriesIndex')->name('accessories-index');
                    Route::post('/create-quick-select-accessories', 'StatisticController@createQuickAccessories')->name('create-quick-accessories');
                });
            });

           
        });

});
