<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>博客系统</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')

<a href="/">全部</a>
@foreach($data['class'] as $class)
    <a href="/?class_id={{$class->id}}">{{$class->name}}</a>
@endforeach

<ui>
@foreach($data['blog'] as $blog)
    <li>
        <a href="blogInfo?id={{$blog->id}}">{{$blog->title}}</a>
        @if(Session::get('isAdmin'))
            <a href="changeBlog?id={{$blog->id}}">编辑</a>|
            <a href="blogDelete?id={{$blog->id}}">删除</a>
        @endif
    </li>
@endforeach
</ui>
</body>
</html>
