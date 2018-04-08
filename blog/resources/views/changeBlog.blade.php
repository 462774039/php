<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>编辑文章</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

</head>
<body>
@include('head')
<form action="changeBlogSubmit" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$data['blog']->id}}">
    标题：<input type="text" name="title" value="{{$data['blog']->title}}"></br>
    分类：
    <select name="class">
        @foreach($data['class'] as $class)
            @if($class->id == $data['blog']->id)
                <option selected = "selected"  value="{{$class->id}}">{{$class->name}}</option>
            @else
                <option value="{{$class->id}}">{{$class->name}}</option>
            @endif
        @endforeach

    </select></br>
    内容：<br/><textarea name="body">{{$data['blog']->body}}</textarea></br>
    <button type="submit">保存</button>
</form>
</body>
</html>
