@extends('admin.base')


@section('content')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>管理员列表</h5>
                        <div class="ibox-tools">
                            <span class="btn btn-primary btn-xs"><b id="tot">{{$data['total']}}</b>&nbsp;条数据</span>
                            <a href="/admin/admin/create" class="btn btn-primary btn-xs">新增管理员</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="project-list">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td class="project-completion center"><small>id</small></td>
                                    <td class="project-completion center"><small>昵称</small></td>
                                    <td class="project-people center" >头像</td>
{{--                                    <td class="project-status center">身份</td>--}}
                                    <td class="project-status center">创建时间</td>
                                    <td class="project-actions center" >操作</td>
                                </tr>

                                @foreach($data['data'] as $value)
                                    <tr>
                                        <td class="project-completion center"><small>{{$value['id']}}</small></td>
                                        <td class="project-completion center"><small>{{$value['nickname']}}</small></td>
                                        <td class="project-completion center" ><img src="{{$value['img']}}" style="max-width: 100px;width: 100px; border-radius: 60px" ></td>
{{--                                        <td class="project-status center">管理员</td>--}}

                                        <td class="project-completion center"><small>{{$value['created_at']}}</small></td>

                                        <td class="project-actions" style="text-align: center">
                                            <a href="/admin/admin/{{$value['id']}}/edit/"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 修改 </a>
                                            <a href="javascript:;" onclick="deletes(this,{{$value['id']}})" class="btn btn-white btn-sm">
                                                <i class="fa fa-folder"></i> 删除
                                            </a>
                                        </td>
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
@endsection


@section('script')
    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <script>
        //ajax修改状态
        {{--function status(obj,id,status){--}}
        {{--    //发送ajax请求--}}
        {{--    if(status){--}}
        {{--        //发送ajax--}}
        {{--        $.post("/admin/admin/ajaxStatus",{id:id,"_token":'{{csrf_token()}}',"status":"0","_method":"post"},--}}
        {{--            function(data){--}}
        {{--                if(data==1){--}}
        {{--                    //更改状态--}}
        {{--                    $(obj).parent().html("<span class='btn btn-danger' onclick='status(this,"+id+",0)' >停用</span>");--}}
        {{--                }else{--}}




        {{--                    layer.msg('状态更改失败');--}}
        {{--                }--}}
        {{--            })--}}
        {{--    }else{--}}
        {{--        //发送ajax--}}
        {{--        $.post("/admin/admin/ajaxStatus",{id:id,"_token":'{{csrf_token()}}',"status":"1","_method":"post"},--}}
        {{--            function(data){--}}
        {{--                if(data==1){--}}
        {{--                    //更改状态--}}
        {{--                    $(obj).parent().html("<span class='btn btn-success' onclick='status(this,"+id+",1)' >启用</span>");--}}
        {{--                }else{--}}
        {{--                    layer.msg('状态更改失败');--}}
        {{--                }--}}
        {{--            })--}}
        {{--    }--}}
        {{--}--}}

        function deletes(obj,id){
            layer.confirm('你确定要删除这条数据吗？', {
                btn: ['确定','取消']
            }, function(){
                $.post("/admin/admin/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        if(data['code']==1000){
                            tot = Number($('#tot').html());
                            $('#tot').html(--tot);
                            $(obj).parent().parent().remove();
                            layer.msg('删除成功');
                        }
                        layer.msg(data['msg']);
                    })
            }, function(){
                layer.msg('取消操作');
            });
        }
    </script>
@endsection


