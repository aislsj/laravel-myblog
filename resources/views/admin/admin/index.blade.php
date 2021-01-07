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

    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>管理员列表</h5>
                        <div class="ibox-tools">
                            <span class="btn btn-primary btn-xs"><b id="tot">{{$tot}}</b>&nbsp;条数据</span>
                            <a href="/admin/admin/create" class="btn btn-primary btn-xs">新增管理员</a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="project-list">

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="project-completion center"><small>id</small></td>
                                        <td class="project-completion center"><small>姓名</small></td>
                                        <td class="project-people " style="text-align: center" >头像</td>
                                        <td class="project-status center">上一次登录时间</td>
                                        <td class="project-status center">身份</td>
                                        <td class="project-status center">状态</td>
                                        <td class="project-actions" style="text-align: center">操作</td>
                                    </tr>

                                    @foreach($admin as $value)
                                    <tr>
                                        <td class="project-completion center"><small>{{$value->id}}</small></td>
                                        <td class="project-completion center"><small>{{$value->name}}</small></td>
                                        <td class="project-completion " style="text-align: center">
                                            <img src="{{$value->admin_img}}" style="max-width: 100px;width: 100px; border-radius: 60px" >
                                        </td>
                                        <td class="project-completion center">
                                            <small>

                                            </small>
                                        </td>
                                        <td class="project-status center">
                                            暂无身份
                                        </td>
                                        <td class="project-completion center">
                                            <small>
                                                @if($value->admin_status)
                                                    <span class="btn btn-success" onclick="status(this,{{$value->id}},1)">启用</span>
                                                @else
                                                    <span class="btn btn-danger" onclick="status(this,{{$value->id}},0)" >停用</span>
                                                @endif
                                            </small>
                                        </td>

                                        <td class="project-actions" style="text-align: center">
                                            <a href="/admin/admin/{{$value->id}}/edit/"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 修改 </a>
                                            <a href="javascript:;" onclick="deletes(this,{{$value->id}})" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 删除 </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>


                            {{--分页效果--}}
                                <div class="panel-footer">
                                    {{$admin->links()}}
                                </div>
                            {{--分页效果end--}}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
    <script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>

    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <script>
       $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
       //ajax修改状态
       function status(obj,id,status){
           //发送ajax请求
           if(status){
               //发送ajax
               $.post("/admin/admin/ajaxStatus",{id:id,"_token":'{{csrf_token()}}',"status":"0","_method":"post"},
                       function(data){
                           if(data==1){
                               //更改状态
                               $(obj).parent().html("<span class='btn btn-danger' onclick='status(this,"+id+",0)' >停用</span>");
                           }else{
                               layer.msg('状态更改失败');
                           }
                       })
           }else{
               //发送ajax
               $.post("/admin/admin/ajaxStatus",{id:id,"_token":'{{csrf_token()}}',"status":"1","_method":"post"},
                       function(data){
                           if(data==1){
                               //更改状态
                               $(obj).parent().html("<span class='btn btn-success' onclick='status(this,"+id+",1)' >启用</span>");
                           }else{
                               layer.msg('状态更改失败');
                           }
                       })
           }
       }

    //ajax删除
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/admin/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
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
    <script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
    </body>

<!-- Mirrored from www.zi-han.net/theme/hplus/projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:44 GMT -->
</html>
