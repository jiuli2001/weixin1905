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
Route::get('/test/adduser','User\LoginController@addUser');
Route::get('/test/redis1','Test\TestController@redis1');
Route::get('/test/redis2','Test\TestController@redis2');
Route::get('/test/xml','Test\TestController@xmlTest');
Route::get('/test/baidu','Test\TestController@baidu');

//Route::get('/wx/index','Wx\WeixinController@index');
Route::get('/wx','Wx\WeixinController@wechat');
Route::post('/wx','Wx\WeixinController@receiv');        //接收微信的推送事件
