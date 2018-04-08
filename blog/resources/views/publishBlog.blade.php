<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>发表文章</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="publishBlogSubmit" method="post">
    {{ csrf_field() }}
    标题：<input type="text" name="title"></br>
    分类：
    <select name="class">
        <option value="-1">请选择分类</option>
        @foreach($class as $data)
            <option value="{{$data->id}}">{{$data->name}}</option>
        @endforeach

    </select></br>
    内容：<br/><textarea name="body"></textarea></br>
    <button type="submit">发布</button>
</form>
</body>
</html>
