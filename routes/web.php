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

Route::get('/', '\App\Http\Controllers\PostController@login');

//个人设置
Route::get('/user/{user}/setting', '\App\Http\Controllers\UserController@setting');
//个人设置操作
Route::post('/user/{user}/settingStore', '\App\Http\Controllers\UserController@settingStore');

//文章模块
//文章列表
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts', '\App\Http\Controllers\PostController@store');
//文章详情
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
//编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//删除文章
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
//文章图片上传
Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');
//提交评论
Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//点赞
Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
//取消赞
Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');

//个人中心
Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

//专题详情页
Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
//投稿
Route::post('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');


//用户模块
//注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
//登陆页面
Route::get('/login', '\App\Http\Controllers\LoginController@index')->name('login');
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');


Route::get('/notices', '\App\Http\Controllers\NoticeController@index');

//后台管理路由器
include_once('admin.php');
