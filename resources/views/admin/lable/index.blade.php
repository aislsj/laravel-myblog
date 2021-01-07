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
</head>

<body class="gray-bg">
<script>
    //记录当前页面url
    document.cookie="url=/admin/lable";
</script>
<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>标签云</h5>
                </div>
                <div class="ibox-content">

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td class="project-completion center"><small></small></td>
                                <td class="project-completion center"><small>标签名</small></td>
                                <td class="project-status center">标签链接</td>
                                <td class="project-actions" style="text-align: center">操作</td>
                            </tr>
                            @foreach($lable as $value)
                                <tr>
                                    <td class="project-completion center"><small></small></td>
                                    <td class="project-completion center"><small>{{$value->name}}</small></td>
                                    <td class="project-completion center"><small>{{$value->link}}</small></td>
                                    <td class="project-actions" style="text-align: center">
                                        <span onclick="deletes(this,{{$value->id}})"   class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 删除 </span>
                                    </td>
                                </tr>
                            @endforeach



                            <form action="/admin/lable"  role="form" enctype="multipart/form-data"  class="form-horizontal m-t"  method="post" >
                                {{csrf_field()}}
                                <tr>
                                    <td class="project-completion center"><small> <span class="btn btn-primary btn-xs">新增标签</span></small></td>
                                    <td class="project-completion center"><small><input type="text" name="name"></small></td>
                                    <td class="project-completion center"><small><input type="text" name="link"></small></td>
                                    <td class="project-actions" style="text-align: center">
                                        <input type="submit" value="保存"  class="btn btn-white btn-sm">
                                    </td>
                                </tr>
                            </form>
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
<script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>



@if (isset($error))
    <script>
        layer.alert('{{$error}}', {icon: 2});
    </script>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            layer.alert('{{$error}}', {icon: 2});
        </script>
    @endforeach
@endif



<script>
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/lable/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
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
<script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>

<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
</html>
