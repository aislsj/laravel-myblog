<!DOCTYPE html>
<html>

<style>
    .center{text-align: center;}
</style>
<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 项目</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">

    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">


    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <script src="{{asset('/org/layer/layer.js')}}" type="text/javascript"></script>

</head>

<body class="gray-bg">

    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">

                <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" >
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="search" id="top-search">
                        </div>
                    </form>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>用户列表</h5>

                        <div class="ibox-tools">
                            <span class="btn btn-primary btn-xs"><b id="tot"></b>{{$num}}&nbsp;条留言</span>
                        </div>


                    </div>
                    <div class="ibox-content">

                        <div class="project-list">

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="project-completion center"><small>id</small></td>
                                        <td class="project-people " style="text-align: center" >用户名</td>
                                        <td class="project-status center">商品名称</td>
                                        <td class="project-actions" style="text-align: center">商品图片</td>
                                        <td class="project-actions" style="text-align: center">内容</td>
                                        <td class="project-actions" style="text-align: center">星级</td>
                                        <td class="project-actions" style="text-align: center">时间</td>
                                        <td class="project-actions" style="text-align: center">状态</td>
                                    </tr>

                                    @foreach($data as $value)
                                    <tr>
                                        <td class="project-completion center">{{$value->id}}</td>
                                        <td class="project-completion center">{{$value->uname}}</td>
                                        <td class="project-completion center">{{$value->gname}}</td>
                                        <td class="project-completion center"><img src="{{$value->img}}" style="width: 100px"></td>
                                        <td class="project-completion center">{{$value->text}}</td>
                                        <td class="project-completion center">{{str_repeat("★",$value->start)}}{{str_repeat("☆",5-$value->start)}}</td>
                                        <td class="project-completion center">{{date('Y-m-d H:i:s',$value->time)}}</td>
                                        <td class="project-completion center">
                                            <select name="cid" class="form-control" id="" onchange="a(this,{{$value->id}})">
                                                @if($value->statu==0)
                                                    <option selected value="0">正常</option>
                                                    <option  value="1">未审核</option>
                                                    <option  value="2">黑名单</option>
                                                @elseif($value->statu==1)
                                                    <option  value="0">正常</option>
                                                    <option selected value="1">未审核</option>
                                                    <option  value="2">黑名单</option>
                                                @else
                                                    <option  value="0">正常</option>
                                                    <option  value="1">未审核</option>
                                                    <option selected value="2">黑名单</option>
                                                @endif
                                            </select>
                                        </td>
                                    </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>




                    {{--分页效果--}}
                    <div class="panel-footer">
                        {{$data->links()}}
                    </div>
                    {{--分页效果end--}}
                    </div>
                </div>
            </div>
        </div>
    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
    <script>
       $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};


       function a(obj,id){
           val = $(obj).val();
           $.post("/admin/user/messagestats",{id:id,'_token':"{{csrf_token()}}","status":val,'_method':'post'},
                   function(data){
                       if(data==1){
                           layer.msg('修改成功');
                       }else {
                           layer.msg('修改失败');
                       }
                   })
       }


    </script>
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    </body>

<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
</html>
