<!doctype html>
<html>
<head>
    <meta charset="gbk">
    <title>樱花灿烂时，万物皆美好 - 一枚正在努力进步的php程序员个人博客网站</title>
    <meta name="keywords" content="{{$myconfig['keywords']}}" />
    <meta name="description" content="{{$myconfig['description']}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::asset('/Style/home/css/base.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/Style/home/css/index.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/Style/home/css/m.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('/Style/home/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/Style/home/js/jquery.easyfader.min.js') }}"></script>
    <script src="{{ URL::asset('/Style/home/js/scrollReveal.js') }}"></script>
    <script src="{{ URL::asset('/Style/home/js/common.js') }}"></script>
    <script src="/Style/home/js/modernizr.js"></script>
</head>
<body>
<header>
    <!--PC端开始-->
    <div class="menu">
        <nav class="nav" id="topnav">
            <h1 class="logo"><a href="http://www.yangqq.com">樱花灿烂时</a></h1>
            <li><a href="/">网站首页</a> </li>
            <li><a href="/about">关于我</a> </li>
            @foreach($list as $value)
                <li><a href="javascript:void(0)">{{$value['name']}}</a>
                    @if(isset($value['son']))
                        <ul class="sub-nav">
                            @foreach($value['son'] as $data)
                                <li><a href="/category/{{$data['id']}}">{{$data['name']}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach


            <li><a href="/time">时间轴</a> </li>
            <div id="search_bar" class="search_bar">
                <form  id="searchform" action="[!--news.url--]e/search/index.php" method="post" name="searchform">
                    <input class="input" placeholder="想搜点什么呢..." type="text" name="keyboard" id="keyboard">
                    <input type="hidden" name="show" value="title" />
                    <input type="hidden" name="tempid" value="1" />
                    <input type="hidden" name="tbname" value="news">
                    <input type="hidden" name="Submit" value="搜索" />
                    <span class="search_ico"></span>
                </form>
            </div>
        </nav>
    </div>
    <!--PC端结束-->


    <!--Phone端开始-->
    <div id="mnav">
        <h2><a href="/" class="mlogo">樱花灿烂时</a><span class="navicon"></span></h2>
        <dl class="list_dl">
            <dt class="list_dt"> <a href="/">网站首页</a> </dt>
            <dt class="list_dt"> <a href="/about">关于我</a> </dt>
            <dt class="list_dt"> <a href="list">学无止境</a> </dt>
            @foreach($list as $value)
                <li><a href="javascript:void(0)">{{$value['name']}}</a>
                    @if(isset($value['son']))
                        <ul class="sub-nav">
                            @foreach($value['son'] as $data)
                                <li><a href="/catrgory/{{$data['id']}}">{{$data['name']}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            <li><a href="/time">时间轴</a> </li>
        </dl>
    </div>
    <!--Phone端结束-->
</header>
