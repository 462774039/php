<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>分类编辑</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="changeClassSubmit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$class->id}}">
    分类：{{$class->name}}</br>
    新名称：<input type="text" name="newName"></br>
    <button type="submit">保存</button>
</form>
</body>
</html>
