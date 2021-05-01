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
Route::middleware(['CheckIfMitra'])->prefix('mitra')->name('mitra.')->namespace('Mitra\Auth')->group(function(){
    Route::get('/', 'PendaftaranController@index')->name('daftar');
    Route::post('/daftar-1', 'PendaftaranController@step1')->name('daftarStep1');
    Route::post('/daftar-2', 'PendaftaranController@step2')->name('daftarStep2');
    Route::post('/daftar/cek-username', 'PendaftaranController@postCheckUsername')->name('postCheckUsername');
    Route::post('/daftar/cek-email', 'PendaftaranController@postCheckEmail')->name('postCheckEmail');
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
