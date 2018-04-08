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
<ui>
    @foreach($class as $data)
        <li>
            <a href="/?class_id={{$data->id}}">{{$data->name}}</a>
            @if(Session::get('isAdmin'))
                <a href="changeClass?id={{$data->id}}">编辑</a>|
                <a href="classDelete?id={{$data->id}}">删除</a>
            @endif
        </li>
    @endforeach
</ui>
</body>
</html>
