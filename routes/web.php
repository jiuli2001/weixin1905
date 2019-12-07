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



Route::get('info',function(){
	phpinfo();
});
Route::get('/test/hello','Test\TestController@hello');
Route::get('/test/adduser','Test\LoginController@adduser');
Route::get('/test/redis1','Test\LoginController@redis1');
Route::get('/test/redis2','Test\LoginController@redis2');

Route::get('/wx','Test\LoginController@weixin');
Route::get('wx/index','Wx\WeixinController@index');
