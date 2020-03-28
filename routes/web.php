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

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
Route::post('store_product', 'HomeController@store_product')->name('store_product');
Route::get('read/{id?}', 'HomeController@read')->name('read');
Route::get('delete/{id?}', 'HomeController@delete')->name('delete');
Route::get('geral_details', 'HomeController@geral_details')->name('geral_details');
