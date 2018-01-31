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

        //管理人员模块
        Route::get('/users', '\App\Admin\Controllers\UserController@index');
        Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
        Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
        Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');  //某一个用户所属角色
        Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');  //修改保存

        //角色相关
        Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
        Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
        Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
        Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission'); //角色和权限关系
        Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

        //权限相关
        Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
        Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
        Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');


        //审核模块
        Route::get('/posts', '\App\Admin\Controllers\PostController@index');
        Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
    });
});