<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$data['blog']->title}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')

<h2 align="center">{{$data['blog']->title}}</h2>
<p align="right">
作者：{{$data['blog']->user_name}}</br>
更新时间：{{$data['blog']->last_time}}</br>
分类:<a href="/?class_id={{$data['blog']->class_id}}">{{$data['blog']->class_name}}</a></br>
@if(Session::get('isAdmin') or $data['blog']->user_id == Session::get('user_id'))
    <a href="changeBlog?id={{$data['blog']->id}}">编辑文章</a>
    <a href="blogDelete?id={{$data['blog']->id}}">删除文章</a>
@endif
</p>
正文：
<p>{{$data['blog']->body}}</p>

评论区：
<ui>
@foreach($data['discuss'] as $discuss)
    <li>
        {{$discuss->body}}
        @if(Session::get('isAdmin') or $discuss->user_id == Session::get('user_id'))
            <a href="discussDeleteSubmit?discuss_id={{$discuss->id}}&user_id={{$discuss->user_id}}&blog_id={{$discuss->blog_id}}">
                删除
            </a>
        @endif
        </br>
        &emsp;评论用户：<a href="userInfo?id={{$discuss->user_id}}">{{$discuss->user_name}}</a>
        时间：{{$discuss->datetime}}
        </br>
    </li>
@endforeach
</ui></br>

<form action="publishDiscussSubmit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="blog_id" value="{{$data['blog']->id}}">
    发表评论：</br>
    <textarea name="body"></textarea>
    <button type="submit">发表</button>
</form>

</body>
</html>
