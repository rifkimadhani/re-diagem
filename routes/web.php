<?php

use Kavist\RajaOngkir\Facades\RajaOngkir;
/* --------------------- Common/User Routes START -------------------------------- */
Route::prefix('wilayah')->group(function() {
    Route::post('/jsonSelect', 'WilayahController@jsonSelect')->name('wilayah.jsonSelect');
});

Route::namespace('Umum')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');

    Route::namespace('Auth')->group(function(){

        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('loginPost');
        Route::post('/logout','LoginController@logout')->name('logout');

        //Register Routes
        Route::get('/register','RegisterController@index')->name('register');
        Route::post('/registerPost','RegisterController@proses')->name('registerPost');

        // //Forgot Password Routes
        // Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        // Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        // //Reset Password Routes
        // Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        // Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');

        // // Email Verification Route(s)
        // Route::get('email/verify','VerificationController@show')->name('verification.notice');
        // Route::get('email/verify/{id}','VerificationController@verify')->name('verification.verify');
        // Route::get('email/resend','VerificationController@resend')->name('verification.resend');
    });

    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/','UserController@index')->name('index');
        Route::get('/profil','UserController@profil')->name('profil');
        Route::get('/pembayaran','OrderController@belum_bayar')->name('belum_bayar');
        Route::get('/pesanan','OrderController@index')->name('pesanan');
        Route::get('/pesanan/invoice/{invoice_no}','OrderController@invoice')->name('invoice');

        Route::group(['prefix' => 'alamat'], function () {
            Route::get('/','AlamatController@index')->name('alamat');
            Route::post('/simpan', 'AlamatController@simpan')->name('alamat.simpan');
            Route::get('/edit/{id}', 'AlamatController@edit')->name('alamat.edit');
            Route::post('/update', 'AlamatController@update')->name('alamat.update');
            Route::get('/hapus/{id}', 'AlamatController@hapus')->name('alamat.hapus');
            Route::get('/json', 'AlamatController@json')->name('alamat.json');
        });
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('/', 'CartController@index')->name('cart');
        Route::get('/data', 'CartController@data')->name('cart.data');
        Route::post('/show-cart-modal', 'CartController@showCartModal')->name('cart.showCartModal');
        Route::post('/addtocart', 'CartController@addToCart')->name('cart.addToCart');
        Route::post('/hapus', 'CartController@hapus')->name('cart.hapus');
        Route::post('/updateQuantity', 'CartController@updateQuantity')->name('cart.updateQuantity');

        Route::group(['prefix' => 'checkout'], function () {
            Route::match(['get', 'post'], '/','CheckoutController@index')->name('checkout');
            Route::post('/pembayaran', 'CheckoutController@pembayaran')->name('checkout.bayar');
            Route::post('/post', 'CheckoutController@simpan')->name('checkout.simpan');
            Route::get('/bayar', 'CheckoutController@bayar');
        });
    });

    Route::post('/variant_price', 'ProdukController@variant_price')->name('variant_price');

    Route::post('/top-data', 'KategoriController@cartTop_data')->name('cart.top_data');

    Route::group(['prefix' => 'c'], function () {
        Route::get('/{kategori}', 'KategoriController@index')->name('kategori.detail');
        Route::post('/sub_kategori_json', 'KategoriController@sub_kategori_json')->name('kategori.sub_kategori_json');
    });

    Route::group(['prefix' => 'promo'], function (){
        Route::get('/', 'PromoController@index')->name('promo');
        Route::get('/{slug}', 'PromoController@detail')->name('promo.detail');
    });

    Route::group(['prefix' => 'product'], function (){
        Route::get('/', 'ProdukController@index')->name('product');
        Route::get('/data', 'ProdukController@data')->name('product.data');
        Route::get('/{produk}', 'ProdukController@detail')->name('product.detail');
    });
    // Route::get('/produk', 'ProdukController@detail')->name('produk.detail');
    // Route::get('/{produk}', 'ProdukController@detail')->name('produk.detail');
});
