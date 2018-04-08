<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>博客系统-注册</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="register_submit" method="post">
    {{ csrf_field() }}
    blog注册</br>
    用户名：<input type="text" name="name"></br>
    密码：<input type="password" name="password"></br>
    确认密码：<input type="password" name="password2"></br>
    <button type="submit">注册</button>
</form>
</body>
</html>
