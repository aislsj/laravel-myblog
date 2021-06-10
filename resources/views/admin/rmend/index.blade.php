
@extends('admin.base')


@section('content')

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>首页推荐展示</h5>
                    <div class="ibox-tools">
                        <a href="/admin/rmend/create" class="btn btn-primary btn-xs">新增首页推荐</a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="project-list">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td class="project-completion center"><small>id</small></td>
                                <td class="project-completion center"><small>标题</small></td>
                                <td class="project-completion center"><small>图片</small></td>
                                <td class="project-actions" style="text-align: center">操作</td>
                            </tr>
                                @foreach($rmends['data'] as $value)
                                    <tr>
                                        <td class="project-completion center"><small>{{$value['id']}}</small></td>
                                        <td class="project-completion center"><small>{{$value['title']}}</small></td>
                                        <td class="" style="text-align: center"><img src="{{$value['img_auth']}}" style="max-width: 100px"></td>
                                        <td class="project-actions" style="text-align: center">
                                            <a href="/admin/rmend/{{$value['id']}}/edit/"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 修改 </a>

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
<script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
<script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>

<script>
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/rmend/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
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
@endsection
