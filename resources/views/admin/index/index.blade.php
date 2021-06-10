<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>H+ 后台主题UI框架 - 主页</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ URL::asset('/Style/admin/css/bootstrap.min14ed.css?v=3.3.6') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Style/admin/css/font-awesome.min93e3.css?v=4.4.0') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Style/admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/Style/admin/css/style.min862f.css?v=4.1.0') }}">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
{{--                        <span><img alt="image" class="img-circle" src="/Style/admin/img/profile_small.jpg"  width="100px;"/></span>--}}
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">Beaut-zihan</strong></span><span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="J_menuItem" href="form_avatar.html">修改头像</a></li>
                            <li><a class="J_menuItem" href="profile.html">个人资料</a></li>
                            <li><a class="J_menuItem" href="mailbox.html">私聊我的</a></li>
                            <li class="divider"></li>
                            <li><a href="admin/logout">安全退出</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">H+</div>
                </li>
                <li>
                    <a class="J_menuItem"  href="admin/homepage" data-index="0"><i class="fa fa-home"></i><span class="nav-label">我的主页</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">我的博客</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a  name="iframe0" class="J_menuItem" width="100%" height="100%" href="/admin/article">文章列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-magic"></i> <span class="nav-label">文章分类</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" name="iframe0" width="100%" height="100%" href="/admin/category">分类详情</a></li>
                    </ul>
                </li>
                {{--<li>--}}
                    {{--<a href="#"><i class="fa fa-edit"></i><span class="nav-label">闲言碎语</span><span class="fa arrow"></span></a>--}}
                    {{--<ul class="nav nav-second-level">--}}
                        {{--<li><a class="J_menuItem" name="iframe0" width="100%" height="100%" href="/admin/user">每日一话</a></li>--}}
                        {{--<li><a href="mailbox.html"><a class="J_menuItem" name="iframe0" width="100%" height="100%" href="/admin/user/message" style="display: inline">留言列表</a><span class="label label-warning pull-right">16</span></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">管理员管理</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" name="iframe0" width="100%" height="100%" href="/admin/admin">管理员列表</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">页面布局</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="/admin/banner">首页轮播图</a></li>
                        <li><a class="J_menuItem" href="/admin/rmend">首页推荐</a></li>
                        <li><a class="J_menuItem" href="/admin/lable">链接标签</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">系统</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem" href="/admin/config">配置项</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i> 主题
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i></button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i></button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span></button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a></li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a></li>
                </ul>
            </div>
            <a href="login.html" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i>退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" id="index_frame" width="100%" height="100%" src="" frameborder="0" data-id="index_v1.html" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; 2014-2015 <a href="http://www.zi-han.net/" target="_blank">zihan's blog</a></div>
        </div>
    </div>
    <!--右侧部分结束-->

    <!--右侧边栏开始-->
    <div id="right-sidebar">
        <div class="sidebar-container">
            <ul class="nav nav-tabs navs-3">
                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-gear"></i> 主题</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2">通知</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> 主题设置</h3>
                        <small><i class="fa fa-tim"></i> 你可以从这里选择和预览主题的布局和样式，这些设置会被保存在本地，下次打开的时候会直接应用这些设置。</small>
                    </div>
                    <div class="skin-setttings">
                        <div class="title">主题设置</div>
                        <div class="setings-item">
                            <span>收起左侧菜单</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="collapsemenu">
                                    <label class="onoffswitch-label" for="collapsemenu">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定顶部</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="fixednavbar" class="onoffswitch-checkbox" id="fixednavbar">
                                    <label class="onoffswitch-label" for="fixednavbar">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>固定宽度</span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="boxedlayout" class="onoffswitch-checkbox" id="boxedlayout">
                                    <label class="onoffswitch-label" for="boxedlayout">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="title">皮肤选择</div>
                        <div class="setings-item default-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-0">默认皮肤</a></span>
                        </div>
                        <div class="setings-item blue-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-1">蓝色主题</a></span>
                        </div>
                        <div class="setings-item yellow-skin nb">
                            <span class="skin-name "><a href="#" class="s-skin-3">黄色/紫色主题</a></span>
                        </div>
                    </div>
                </div>

                <div id="tab-2" class="tab-pane">
                    <div class="sidebar-title">
                        <h3> <i class="fa fa-comments-o"></i> 最新通知</h3>
                        <small><i class="fa fa-tim"></i> 您当前有10条未读信息</small>
                    </div>
                    <div>
                        <div class="sidebar-message">
                            <a href="#">
                                <div class="pull-left text-center">
                                    <img alt="image" class="img-circle message-avatar" src="/Style/admin/img/a1.jpg">
                                    <div class="m-t-xs">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="media-body">据天津日报报道：瑞海公司董事长于学伟，副董事长董社轩等10人在13日上午已被控制。
                                    <br>
                                    <small class="text-muted">今天 4:21</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <!--右侧边栏结束-->


</div>


<script>
    var iframe = document.getElementById('index_frame');
    if(iframe.getAttribute('src')!=''){
        iframe.setAttribute('src','/admin/iframe_con');//判断第一次进入页面时，显示的是第一个页面，详见ps
    }
    function getCookie(url) {
        if (document.cookie.length>0) {
            var strCookie=document.cookie;
            //将多cookie切割为多个名/值对
            var arrCookie=strCookie.split("; ");
            //遍历cookie数组，处理每个cookie对
            for(var i=0;i<arrCookie.length;i++){
                var arr=arrCookie[i].split("=");
                //找到名称为userId的cookie，并返回它的值
                if(url==arr[0]){
                    return(arr[1]);
                    break;
                }
            }
        }
    }
    iframe.setAttribute('src',getCookie('url'));//重新设置获取的url，实现刷新显示当前页面
</script>

<script type="text/javascript" src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
<script type="text/javascript" src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script type="text/javascript" src="/Style/admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script type="text/javascript" src="/Style/admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/Style/admin/js/plugins/layer/layer.min.js"></script>
<script type="text/javascript" src="/Style/admin/js/hplus.min.js?v=4.1.0"></script>
<script type="text/javascript" src="/Style/admin/js/contabs.min.js"></script>
<script type="text/javascript" src="/Style/admin/js/plugins/pace/pace.min.js"></script>
</body>
</html>
