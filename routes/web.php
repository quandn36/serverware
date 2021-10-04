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

Route::name('home.')->group(function() {
    Route::get('/', 'HomeController@home')->name("home");
    Route::get('/about', 'HomeController@about')->name("about");
     Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name("privacy-policy");
    Route::get('/login', 'HomeController@logIn')->name("login");
    Route::post('/log-in', 'HomeController@SendMail')->name("send-mail");
    Route::post('/post-login','HomeController@PostLogin')->name("postlogin");
    Route::get('/account', 'HomeController@account')->name("account")->middleware('chekuserauthhomepage');
    Route::get('/account/order-detail-{id}', 'HomeController@OrderDetail')->name("order-detail");
    Route::put('/cancelorder', 'HomeController@CancelOrder')->name('cancel-order');
    Route::put('/reorder', 'HomeController@ReOrder')->name('re-order');
    Route::get('/logout','HomeController@logout')->name('logout');
    Route::get('/contact', 'HomeController@contact')->name("contact");
    Route::get('/basket', 'HomeController@basket')->name("basket");
    Route::get('/product-hold-detail/{id}', 'HomeController@productHoldDetail')->name("product-hold-detail");
    Route::get('/product-type-detail/{id}', 'HomeController@productMenuDetail')->name("product-menu-detail");
    Route::post('/load-ajax-filter', 'HomeController@LoadAJaxfilter')->name('load-ajax-filter');
    Route::get('/{slugname}-{id}', 'HomeController@urlCategory')->where('id','\d+$')->where('slugname','^[a-z0-9-]+')->name("category-list");
    Route::get('/{slug}', 'HomeController@categoryDetail')->name("category-detail");
    Route::get('/{slugCategory}/{slug?}', 'HomeController@productDetail')->name("product-detail");
    Route::prefix('invoice')->group(function(){
        Route::name('invoice.')->group(function(){
            Route::get('/checkout/index', 'InvoiceController@index')->name("check-out");
            Route::post('/create','InvoiceController@create')->name("create");
            Route::post('/check-user','InvoiceController@checkUser')->name("check-user");
              
        });
    });
    Route::prefix('basket')->group(function(){
        Route::name('basket.')->group(function(){
            Route::get('/','BasketController@view')->name('view');
            Route::post('/add-basket/{id}','BasketController@add')->name('add');
            Route::post('/add-basket-1-sp/{id}','BasketController@add');
            Route::get('/remove-basket/{id}','BasketController@remove')->name('remove');
            Route::post('/update-basket','BasketController@updateQty')->name('update');
            Route::post('/update-re-configure/{id}','BasketController@updateReConfigure')->name('update-re-configure');
            Route::get('/clear-basket/{id}','BasketController@clear')->name('clear'); 
            Route::get('re-configure/{slug}/basket_id/{id_basket}','BasketController@reConfigure')->name('re-configure');
        });
    });

    Route::prefix('invoice')->group(function(){
        Route::name('invoice.')->group(function(){
            Route::post('/add-new','InvoiceController@store')->name('store');
            
        });
    });



});

