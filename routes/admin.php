<?php

/* ----------------------- Admin Routes START -------------------------------- */

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){
    Route::namespace('Auth')->group(function(){

        //Login Routes
        Route::get('/','LoginController@showLoginForm');
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login');
        Route::post('/logout','LoginController@logout')->name('logout');

        //Register Routes
        // Route::get('/register','RegisterController@showRegistrationForm')->name('register');
        // Route::post('/register','RegisterController@register');

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

    Route::get('/beranda','BerandaController@index')->name('beranda');

    Route::group(['prefix' => 'produk'], function () {
        Route::get('/','ProdukController@index')->name('produk');
        Route::get('/tambah','ProdukController@tambah')->name('produk.tambah');
        Route::post('/simpan','ProdukController@simpan')->name('produk.simpan');
        Route::get('/edit/{id}','ProdukController@edit')->name('produk.edit');
        Route::post('/update','ProdukController@update')->name('produk.update');
        Route::get('/hapus/{id}','ProdukController@hapus')->name('produk.hapus');
        Route::get('/json','ProdukController@json')->name('produk.json');
        Route::post('/add_variasi','VariasiController@add_variasi')->name('variasi_update');
        Route::post('/get_variasi','VariasiController@get_variasi')->name('variasi_get');

        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/','KategoriController@index')->name('kategori');
            Route::post('/json','KategoriController@json')->name('kategori.json');
            Route::get('/tree','KategoriController@tree')->name('kategori.tree');
            Route::post('/simpan','KategoriController@simpan')->name('kategori.simpan');
            Route::get('/edit/{id}','KategoriController@edit')->name('kategori.edit');
            Route::post('/update','KategoriController@update')->name('kategori.update');
            Route::get('/hapus/{id}','KategoriController@hapus')->name('kategori.hapus');
        });
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/','OrderController@index')->name('order');
        Route::get('/confirm','OrderController@confirm')->name('order.confirm');
        Route::get('/dikirim','OrderController@dikirim')->name('order.dikirim');
        Route::get('/cancel','OrderController@cancel')->name('order.cancel');
    });

    Route::group(['prefix' => 'promo'], function () {
        Route::get('/','PromoController@index')->name('promo');
        Route::get('/tambah','PromoController@tambah')->name('promo.tambah');
        Route::post('/simpan','PromoController@simpan')->name('promo.simpan');
        Route::get('/edit/{id}','PromoController@edit')->name('promo.edit');
        Route::post('/update','PromoController@update')->name('promo.update');
        Route::get('/hapus/{id}','PromoController@hapus')->name('promo.hapus');
    });

    Route::group(['prefix' => 'keuangan'], function () {

        Route::group(['prefix' => 'rekening-bank'], function () {
            Route::get('/','RekeningController@index')->name('rekening');
            Route::post('/simpan', 'RekeningController@simpan')->name('rekening.simpan');
            Route::get('/edit/{id}', 'RekeningController@edit')->name('rekening.edit');
            Route::post('/update', 'RekeningController@update')->name('rekening.update');
            Route::get('/hapus/{id}', 'RekeningController@hapus')->name('rekening.hapus');
            Route::post('/bank', 'RekeningController@bank')->name('rekening.bank');
        });
        
    });



    

});

/* ----------------------- Admin Routes END -------------------------------- */
