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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/{id}', 'HomeController@index');

Route::get('/login', 'LoginController@index');
Route::post('/login/process', 'LoginController@checkLogin');
Route::get('/logout', 'LoginController@logout');

Route::get('/pesanan/buat/{id}', 'PesananController@menus');
Route::post('/pesanan/process/{id}', 'PesananController@process');
Route::post('/pesanan/simpan/{id}', 'PesananController@simpan');
Route::get('/pesanan/daftar/{id}', 'PesananController@daftar');
Route::get('/pesanan/lihat', 'PesananController@lihat');
Route::get('/pesanan/edit', 'PesananController@edit');
Route::post('/pesanan/edit/simpan/{id}', 'PesananController@editSimpan');
Route::get('/pesanan/bayar', 'PesananController@bayar');
Route::post('/pesanan/bayar/process', 'PesananController@bayarProcess');