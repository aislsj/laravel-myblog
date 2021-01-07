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

    <style>
        .queren{display: none}
    </style>
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>订单状态列表</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-xs"></a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="project-list">

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="project-completion center col-sm-1"><small>id</small></td>
                                <td class="project-completion center col-sm-1"><small>订单状态名</small></td>
                                <td class="project-completion center col-sm-1"><small></small></td>
                                <td class="project-completion center  col-sm-9"><small></small></td>
                            </tr>

                            @foreach($data as $value)
                                <tr>
                                    <td class="project-completion center col-sm-1"><small>{{$value->id}}</small></td>
                                    <td class="project-completion center col-sm-1">
                                        <small class="11">
                                            <input class="form-control" type="text" value="{{$value->name}}">
                                        </small>
                                    </td>
                                    <td class="project-completion center col-sm-1"><small><button onclick="save(this,{{$value->id}})" class="btn btn-primary queren" type="submit">修改</button></small></td>
                                    <td class="project-completion center  col-sm-9"><small></small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>

<script>
    $("input[type=text]").click(function(){
        $('.queren').hide();
       $(this).parent().parent().next().children().children().show();
    });


    //数据修改
    function save(obj,id){
        //获取用户输入的信息
        name =  $(obj).parent().parent().prev().children().children().val();
        $.post('/admin/addr/addrlist/edit',{id:id,name:name,'_token':'{{csrf_token()}}'},function(data){

            if(data){
                layer.msg('修改成功');
            }else {
                layer.msg('修改失败');
            }
        });
    }
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
</html>
