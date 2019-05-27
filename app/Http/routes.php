<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
// Auth::routes();
// Route::post('/login', 'MyloginController@index');
Route::post('/cart', 'FrontController@cart');
// Route::post('/cart', 'FrontController@index');
Route::get('/destroy', 'FrontController@destroy');
// Route::post('/cart', 'Front@cart');
Route::get('/home', 'FrontController@test');
Route::get('/update/{product_id}/{increment}','FrontController@update');
Route::get('/update/{product_id}/{decrease}','FrontController@update');
Route::get('/delete/{product_id}','FrontController@delete');