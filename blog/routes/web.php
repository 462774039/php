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

//测试数据库是否连接成功
Route::get('db',function (){
    $name = DB::connection()->getDatabaseName();
    echo $name;
});

//首页
Route::get('/', "Controller@index");

//登陆页面
Route::get('login', function(){
    return view('login');
});

//登陆请求
Route::post('login_submit', 'Controller@loginSubmit');

//登出请求
Route::get('login_out', 'Controller@loginOut');

//注册页面 register
Route::get('register', function(){
    return view('register');
});

//注册请求
Route::post('register_submit', 'Controller@registerSubmit');

//博客文章页
Route::get('blogInfo', 'blogController@blogInfo');

//发布博客页
Route::get('publishBlog', 'blogController@publishBlog');

//发布博客请求
Route::post('publishBlogSubmit', 'blogController@publishBlogSubmit');

//编辑博客页
Route::get('changeBlog', 'blogController@changeBlog');

//编辑博客请求
Route::post('changeBlogSubmit', 'blogController@changeBlogSubmit');

//删除指定博客
Route::get('blogDelete', 'blogController@blogDelete');

//分类列表页
Route::get('classList', 'classController@classList');

//编辑分类页
Route::get('changeClass', 'classController@changeClass');

//编辑分类请求
Route::post('changeClassSubmit', 'classController@changeClassSubmit');

//删除指定分类
Route::get('classDelete', 'classController@classDelete');

//用户列表页
Route::get('userList', 'userController@userList');

//编辑用户页
Route::get('changeUser', 'userController@changeUser');

//编辑用户请求
Route::post('changeUserSubmit', 'userController@changeUserSubmit');

//删除指定用户
Route::get('userDelete', 'userController@userDelete');

//用户信息页
Route::get('userInfo', 'userController@userInfo');

//修改密码页
Route::get('changePassword', 'userController@changePassword');

//修改密码请求
Route::post('changePasswordSubmit', 'userController@changePasswordSubmit');

//修改个人信息请求
Route::post('changeSelfInfoSubmit', 'userController@changeSelfInfoSubmit');

//发布评论请求
Route::post('publishDiscussSubmit', 'blogController@publishDiscussSubmit');

//删除评论请求
Route::get('discussDeleteSubmit', 'blogController@discussDeleteSubmit');