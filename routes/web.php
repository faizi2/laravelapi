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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('refresh','HomeController@refresh')->name('refresh');


Route::get('curl','CurlController@index');

Route::get('curl1','CurlController@getdata')->name('getdata');

Route::get('getdetails','CurlController@getdetails')->name('getdetails');
