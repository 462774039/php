<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use DB;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //首页
    public function index()
    {
        $classID = Request::get('class_id');
        if($classID){
            $blog = blogController::getClassBlogAll($classID);
        }else{
            $blog = blogController::getBlogAll();
        }

        $class = classController::getClassAll();
        $data = [
            'blog' => $blog,
            'class' => $class
        ];
        return view('index', compact('data'));
    }

    //登陆提交处理
    public function loginSubmit()
    {
        $name = Request::input('name');
        $password = Request::input('password');
        $user = DB::table('users')->where('name', $name)->where('password', $password)->first();
        if($user){
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('isAdmin', $user->isAdmin);
            $blog = blogController::getBlogAll();
            $class = classController::getClassAll();
            $data = [
                'blog' => $blog,
                'class' => $class
            ];
            return view('index', compact('data'));
        }else{
            echo "账号或密码错误";
        }
    }

    //登出处理
    public function loginOut()
    {
        if (Session::has('user_id'))
        {
            Session::forget('user_id');
        }

        if (Session::has('user_name'))
        {
            Session::forget('user_name');
        }

        if (Session::has('isAdmin'))
        {
            Session::forget('isAdmin');
        }
        $blog = blogController::getBlogAll();
        $class = classController::getClassAll();
        $data = [
            'blog' => $blog,
            'class' => $class
        ];
        return view('index', compact('data'));
    }

    //注册请求
    public function registerSubmit()
    {
        $name = Request::input('name');
        $password = Request::input('password');
        $password2 = Request::input('password2');
        if($password != $password2){
            echo "两次密码不一致";
        }else{
            $isUser = DB::table('users')->where('name', $name)->first();
            if($isUser){  //用户已存在
                echo "该用户名已被使用";
            }else{
                $user_id = DB::table('users')->insertGetId(
                    ['name' => $name, 'password' => $password]
                );
                echo "<script>alert(\"注册成功\")</script>";
                Session::put('user_id', $user_id);
                Session::put('user_name', $name);
                Session::put('isAdmin', 0);
                $blog = blogController::getBlogAll();
                $class = classController::getClassAll();
                $data = [
                    'blog' => $blog,
                    'class' => $class
                ];
                return view('index', compact('data'));
            }
        }
    }

}