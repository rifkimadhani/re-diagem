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

Route::prefix('mitra')->name('mitra.')->namespace('Mitra\Auth')->group(function() {
    Route::get('/login','LoginController@showLoginForm')->name('login');
    Route::post('/login','LoginController@login')->name('loginPost');
});

Route::prefix('mitra')->name('mitra.')->namespace('Mitra')->group(function() {
    Route::get('/beranda','BerandaController@index')->name('beranda');
    Route::get('/getTotal','BerandaController@getTotal')->name('beranda.getTotal');

    
    Route::group(['prefix' => 'promosi'], function () {
        Route::get('/','PromosiController@index')->name('promosi');
    });

    Route::group(['prefix' => 'toko'], function () {
        Route::get('/','TokoController@index')->name('toko.profil');
        Route::post('/update','TokoController@update')->name('toko.update');

        Route::group(['prefix' => 'etalase'], function () {
            Route::get('/','EtalaseTokoController@index')->name('etalase');
            Route::post('/simpan', 'EtalaseTokoController@simpan')->name('etalase.simpan');
            Route::get('/edit/{id}', 'EtalaseTokoController@edit')->name('etalase.edit');
            Route::post('/update', 'EtalaseTokoController@update')->name('etalase.update');
            Route::get('/hapus/{id}', 'EtalaseTokoController@hapus')->name('etalase.hapus');
        });
    });
});
