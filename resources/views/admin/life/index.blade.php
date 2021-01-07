<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台管理系统</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">


    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
    <script src="/Style/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <link href="/Style/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
</head>

<body class="gray-bg">

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>所有分类</h5>
                    <div class="ibox-tools">
                        <a href="/admin/life/create" class="btn btn-primary btn-xs">新增分类</a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="project-list">
                        <form action="1" method="post">
                            <table class="table table-hover">
                                <tbody>

                                <tr>
                                    <td class="col-md-1" style="text-align: center">id</td>
                                    <td class="col-md-1" style="text-align: center">分类名</td>
                                    <td class="col-md-1" style="text-align: center">排序</td>
                                    <td class="col-md-3" style="text-align: center"> 操作</td>
                                </tr>


                                @foreach($data as $value)
                                <tr>
                                    <td class="col-md-1" style="text-align: center">{{$value->id}}</td>
                                    <td class="col-md-1" style="text-align: center">{{$value->catename}}</td>
                                    <td class="col-md-1" style="text-align: center">{{$value->sort}}</td>

                                    <td class="col-md-3" style="text-align: center">
                                        <a href="/admin/life/{{$value->id}}/edit/" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> 编辑 </a>
                                        <span  onclick="del(this,{{$value->id}})" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> 删除 </span>
                                    </td>
                                </tr>
                                @endforeach



                                <tr>
                                    <td class="col-md-1"></td>
                                    <td class="col-md-1" ></td>
                                    <td class="col-md-1" style="text-align: center"><input type="submit" value="排序"></td>
                                    <td class="col-md-1"></td>
                                    <td class="col-md-1"></td>
                                    <td class="col-md-1"></td>
                                    <td class="col-md-2"></td>
                                    <td class="col-md-1"></td>
                                    <td class="col-md-4"></td>
                                </tr>

                                </tbody>
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
<script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>

<script>
    function del(obj,id){
        layer.confirm('你确定要删除这条分类吗', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/life/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        //判断是否成功
                        if(data==1){
                            //移除数据
                            tot = Number($('#tot').html());
                            $('#tot').html(--tot);
                            $(obj).parent().parent().remove();
                            layer.msg('删除成功');
                        }else {
                            layer.msg('删除失败')
                        }
                    })
        }, function(){
            layer.msg('取消操作');
        });
    }

</script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
</html>
