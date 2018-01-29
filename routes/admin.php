<?php

//管理后台
Route::group(['prefix'=>'admin'], function (){

    //后台登陆
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    //登录行为
    Route::post('login', '\App\Admin\Controllers\LoginController@login');
    //登出行为
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');


    //该路由的定义必须经过auth的检测
    Route::group(['middleware' => 'auth:admin'], function(){
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');
    });
});