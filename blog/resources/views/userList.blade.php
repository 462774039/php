<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>分类管理</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="userList" method="get">
    搜索：<input type="text" name="key">
    <button type="submit">查找</button>
    </br></br>
</form>

用户列表：
<ui>
    @foreach($user as $data)
        <li>
            <a href="userInfo?id={{$data->id}}">{{$data->name}}</a>
            @if(Session::get('isAdmin'))
                <a href="changeUser?id={{$data->id}}">编辑</a>|
                <a href="userDelete?id={{$data->id}}">删除</a>
            @endif
        </li>
    @endforeach
</ui>
</body>
</html>
