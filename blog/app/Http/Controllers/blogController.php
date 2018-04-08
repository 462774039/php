<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use DB;
use Session;

//博客控制器
class blogController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //获取所有博客内容
    public static function getBlogAll()
    {
        $blog = DB::table('blog')->where('isDelete', 0)->get();
        return $blog;
    }

    //获取值得分类的所有博客内容
    public static function getClassBlogAll($classID)
    {
        $blog = DB::table('blog')->where('class_id', $classID)->where('isDelete', 0)->get();
        return $blog;
    }
/*
    //获取指定id博客的数据
    public function getBlog($blogID)
    {
        $blog = DB::table('blog')->where('id', $blogID)->where('isDelete', 0)->first();
        return $blog;
    }
*/
    //获取指定id博客的数据(同时附带作者名和分类名)
    public function getBlog($blogID)
    {
        $blog = DB::table('blog')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('class', 'class_id', '=', 'class.id')
            ->select('blog.id', 'blog.title', 'blog.body', 'blog.last_time', 'blog.user_id',
                'blog.class_id', 'users.name as user_name', 'class.name as class_name')
            ->where('blog.id', $blogID)->where('blog.isDelete', 0)->first();
        return $blog;
    }

    //获取指定博客所有评论(包括评论用户的用户名)
    public static function getBlogDiscuss($blogID)
    {
        $blog = DB::table('discuss')
            ->join('users', 'discuss.user_id', '=', 'users.id')
            ->select('discuss.id', 'discuss.body', 'discuss.datetime', 'discuss.user_id',
                'discuss.blog_id', 'users.name as user_name')
            ->where('blog_id', $blogID)->where('discuss.isDelete', 0)->get();
        return $blog;
    }


    //博客文章详情页
    public function blogInfo()
    {
        $blogID = Request::get('id');
        $blog = self::getBlog($blogID);
        $discuss = self::getBlogDiscuss($blogID);
        $data = [
            'blog' => $blog,
            'discuss' => $discuss
        ];
        return view('blogInfo', compact('data'));
    }

    //发布博客页
    public function publishBlog()
    {
        if(Session::get('isAdmin')){
            $class = classController::getClassAll();
            return view('publishBlog', compact('class'));
        }else{
            return '您没有访问该页的权限';
        }

    }

    //发布博客请求
    public function publishBlogSubmit()
    {
        if(Session::get('isAdmin')){
            $title = Request::post('title');
            $body = Request::post('body');
            $classID =  Request::post('class');
            $userID = Session::get('user_id');
            date_default_timezone_set('Asia/Shanghai');

            DB::table('blog')->insert(
                ['title' => $title, 'body' => $body,
                 'class_id' => $classID, 'user_id' => $userID,
                 'last_time' => date('y-m-d G:i:s',time())
                ]
            );
            echo "<script>alert(\"发布成功\")</script>";
            $blog = self::getBlogAll();
            $class = classController::getClassAll();
            $data = [
                'blog' => $blog,
                'class' => $class
            ];
            return view('index', compact('data'));
        }else{
            return '没有操作权限';
        }
    }

    //编辑博客页
    public function changeBlog()
    {
        if(Session::get('isAdmin')){
            $blogId = Request::get('id');
            $blog = self::getBlog($blogId);
            $class = classController::getClassAll();
            $data = [
                'blog' => $blog,
                'class' => $class
            ];
            return view('changeBlog', compact('data'));
        }else{
            return '您没有访问该页的权限';
        }

    }

    //编辑博客请求
    public function changeBlogSubmit()
    {
        if(Session::get('isAdmin')){
            $id = Request::post('id');
            $title = Request::post('title');
            $body = Request::post('body');
            $classID =  Request::post('class');
            $userID = Session::get('user_id');
            date_default_timezone_set('Asia/Shanghai');

            DB::table('blog')
                ->where('id',$id)
                ->update(
                ['title' => $title, 'body' => $body,
                    'class_id' => $classID, 'user_id' => $userID,
                    'last_time' => date('y-m-d G:i:s',time())


                ]
            );
            echo "<script>alert(\"编辑成功\")</script>";
            $blog = self::getBlogAll();
            $class = classController::getClassAll();
            $data = [
                'blog' => $blog,
                'class' => $class
            ];
            return view('index', compact('data'));
        }else{
            return '没有操作权限';
        }
    }

    //删除指定博客
    public function blogDelete()
    {
        if(Session::get('isAdmin')) {
            $blogId = Request::get('id');
            DB::table('blog')->where('id', $blogId)->update(['isDelete' => 1]);
            $blog = self::getBlogAll();
            $class = classController::getClassAll();
            $data = [
                'blog' => $blog,
                'class' => $class
            ];
            return view('index', compact('data'));
        }else{
            return "没有操作权限";
        }
    }

    //发布评论请求
    public function publishDiscussSubmit()
    {
        $userID = Session::get('user_id');
        $body = Request::post('body');
        $blogID = Request::post('blog_id');
        date_default_timezone_set('Asia/Shanghai');
        DB::table('discuss')->insert(
            [
                'user_id' => $userID, 'body' => $body, 'blog_id' => $blogID,
                'datetime' => date('y-m-d G:i:s',time())
            ]
        );
        echo "<script>alert(\"发表成功\")</script>";

        $blog = self::getBlog($blogID);
        $discuss = self::getBlogDiscuss($blogID);

        $data = [
            'blog' => $blog,
            'discuss' => $discuss
        ];
        return view('blogInfo', compact('data'));
    }

    //删除评论请求
    public function discussDeleteSubmit()
    {
        $userID = Request::get('user_id');
        if(Session::get('isAdmin') or Session::get('user_id') == $userID) {
            $discussID = Request::get('discuss_id');
            DB::table('discuss')->where('id', $discussID)->update(['isDelete' => 1]);
            $blogID = Request::get('blog_id');
            $blog = self::getBlog($blogID);
            $discuss = self::getBlogDiscuss($blogID);

            $data = [
                'blog' => $blog,
                'discuss' => $discuss
            ];
            return view('blogInfo', compact('data'));
        }else{
            return "没有操作权限";
        }
    }
}