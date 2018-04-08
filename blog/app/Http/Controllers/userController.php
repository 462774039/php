<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use DB;
use Session;

//用户控制器
class userController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //获取所有用户(不包括admin账户)
    public static function getUserAll()
    {
        $users = DB::table('users')->where('isDelete', 0)->where('isAdmin', 0)->get();
        return $users;
    }

    //获取关键字用户(不包括admin账户)
    public static function getKeyUser($key)
    {
        $users = DB::table('users')->where('isDelete', 0)->where('isAdmin', 0)
            ->where('name', 'like', "%$key%")->get();
        return $users;
    }

    //获取指定用户
    public static function getUser($userID)
    {
        $user= DB::table('users')->where('id', $userID)->where('isDelete', 0)->first();
        return $user;
    }

    //用户管理首页
    public function userList()
    {
        if(Session::get('isAdmin')){
            $key = Request::get('key');
            if($key != ''){
                $user = self::getKeyUser($key);
            }else{
                $user = self::getUserAll();
            }
            return view('userList', compact('user'));
        }else{
            return "您没有访问该页权限";
        }
    }

    //编辑用户页
    public function changeUser()
    {
        if(Session::get('isAdmin')){
            $userId = Request::get('id');
            $user = self::getUser($userId);
            return view('changeUser', compact('user'));
        }else{
            return "您没有访问该页权限";
        }
    }

    //编辑用户请求
    public function changeUserSubmit()
    {
        if(Session::get('isAdmin')){
            $id = Request::post('id');
            $name = Request::post('name');
            $password = Request::post('password');
            DB::table('users')->where('id',$id)->update(['name' => $name]);

            if($password != ''){
                DB::table('users')->where('id',$id)->update(['password' => $password]);
            }
            echo "<script>alert(\"编辑成功\")</script>";
            $user= self::getUserAll();
            return view('userList', compact('user'));
        }else{
            return '没有操作权限';
        }
    }

    //删除指定用户
    public function userDelete()
    {
        if(Session::get('isAdmin')) {
            $userID = Request::get('id');
            DB::table('users')->where('id', $userID)->update(['isDelete' => 1]);
            $user= self::getUserAll();
            return view('userList', compact('user'));
        }else{
            return "没有操作权限";
        }
    }

    //用户个人中心页
    public function userInfo()
    {
        $userID = Request::get('id');
        $user = self::getUser($userID);
        return view('userInfo', compact('user'));
    }

    //修改密码页
    public function changePassword()
    {
        $userID = Request::get('id');
        $user = self::getUser($userID);
        return view('changePassword', compact('user'));
    }

    //修改密码请求
    public function changePasswordSubmit()
    {
        $id = Request::post('id');
        $password = Request::post('password');
        $newPassword = Request::post('newPassword');
        $newPassword2 = Request::post('newPassword2');
        if(Session::get('user_id') == $id){
            $user = self::getUser($id);
            $oldPassword = $user->password;
            if($password != $oldPassword){
                return "原密码错误！";
            }
            if($newPassword != $newPassword2){
                return "两次密码不一致！";
            }
            DB::table('users')->where('id',$id)->update(['password' => $newPassword]);
            echo "<script>alert(\"修改成功\")</script>";
            return view('userInfo', compact('user'));
        }else{
            return "操作失败";
        }
    }

    //修改个人信息请求
    public function changeSelfInfoSubmit()
    {
        $userID = Request::post('user_id');
        if(Session::get('user_id') == $userID){
            $qq = Request::post('qq');
            $email = Request::post('email');
            $makeFriends = Request::post('make_friends');
            $selfInfo = Request::post('self_info');
            DB::table('users')->where('id',$userID)->update([
                'qq' => $qq, 'email' => $email,
                'make_friends' => $makeFriends,
                'self_info' => $selfInfo
            ]);
            echo "<script>alert(\"保存成功\")</script>";
            $user = self::getUser($userID);
            return view('userInfo', compact('user'));
        }else{
            return "操作失败";
        }
    }

}