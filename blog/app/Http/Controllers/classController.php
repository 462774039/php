<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use DB;
use Session;

//分类控制器
class classController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //获取所有分类
    public static function getClassAll()
    {
        $class = DB::table('class')->where('isDelete', 0)->get();
        return $class;
    }

    //获取指定分类
    public static function getClass($classID)
    {
        $class= DB::table('class')->where('id', $classID)->where('isDelete', 0)->first();
        return $class;
    }

    //分类管理首页
    public function classList()
    {
        if(Session::get('isAdmin')){
            $class = self::getClassAll();
            return view('classList', compact('class'));
        }else{
            return "您没有访问该页权限";
        }
    }

    //编辑分类名称
    public function changeClass()
    {
        if(Session::get('isAdmin')){
            $classId = Request::get('id');
            $class = self::getClass($classId);
            return view('changeClass', compact('class'));
        }else{
            return "您没有访问该页权限";
        }
    }

    //编辑分类请求
    public function changeClassSubmit()
    {
        if(Session::get('isAdmin')){
            $id = Request::post('id');
            $newName = Request::post('newName');

            DB::table('class')
                ->where('id',$id)
                ->update(
                    ['name' => $newName]
                );
            echo "<script>alert(\"编辑成功\")</script>";
            $class= self::getClassAll();
            return view('classList', compact('class'));
        }else{
            return '没有操作权限';
        }
    }

    //删除指定分类
    public function classDelete()
    {
        if(Session::get('isAdmin')) {
            $classID = Request::get('id');
            DB::table('class')->where('id', $classID)->update(['isDelete' => 1]);
            $class = self::getClassAll();
            return view('classList', compact('class'));
        }else{
            return "没有操作权限";
        }
    }

}