<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台管理系统</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
    <style>

    </style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">H+</h1>
            </div>
            <h3>欢迎使用 H+ 后台管理系统</h3>
            <form class="m-t" role="form" action="/admin/login/check" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="name" class="form-control" placeholder="用户名" required="" name="name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required="" name="password">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="验证码" class="form-control"required="" name="code" style="width:80px;float: left;margin-top: 18px">
                    <div style="width: 220px;float: left;height: 80px">
                        <img src="/admin/yzm" alt="captcha" onclick="this.src='/admin/yzm?m'+Math.random();" style="cursor:pointer"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
                <p class="text-muted text-center">
                    <a href="login.html#"><small>忘记密码了？</small></a>
                </p>
            </form>
        </div>
    </div>
    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:18:23 GMT -->
</html>
