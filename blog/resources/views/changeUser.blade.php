<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>用户编辑</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="changeUserSubmit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$user->id}}">
    用户名：<input type="text" value="{{$user->name}}" name="name"></br>
    密码：<input type="password" name="password"> (留空为不修改密码)</br>
    <button type="submit">保存</button>
</form>
</body>
</html>
