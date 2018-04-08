@if(Session::get('user_id', -1) > 0)
    <p align="right">
        欢迎回来,{{Session::get('user_name')}}|
        <a href="/">首页</a>|
        @if(Session::get('isAdmin', 0))
            <a href="publishBlog">发表文章</a>|
            <a href="classList">分类管理</a>|
            <a href="userList">用户管理</a>|
        @endif
        <a href="userInfo?id={{Session::get('user_id')}}">个人中心</a>|
        <a href="login_out">注销</a>
    </p>
@else
    <p align="right">
        <a href="register">注册</a>
        <a href="login">登陆</a>
    </p>
@endif

<hr>