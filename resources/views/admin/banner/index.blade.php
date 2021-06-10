
@extends('admin.base')


@section('content')
<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>轮播图展示</h5>
                    <div class="ibox-tools">
                        <a href="/admin/banner/create" class="btn btn-primary btn-xs">新增轮播图</a>
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
                                <td class="project-status center">文章链接</td>

                                <td class="project-status center">友情链接</td>
                                <td class="project-status center">排序</td>
                                <td class="project-actions" style="text-align: center">操作</td>
                            </tr>
                            @foreach($data as $value)
                                <tr>
                                    <td class="project-completion center"><small>{{$value['id']}}</small></td>
                                    <td class="project-completion center"><small>{{$value['banner_title']}}</small></td>
                                    <td class="" style="text-align: center"><img src="{{$value['banner_img']}}" style="max-width: 100px"></td>
                                    <td class="project-completion center"><small>{{$value['articlelink']}}</small></td>
                                    <td class="project-completion center"><small>{{$value['interlink']}}</small></td>
                                    <td class="project-completion center"><small>{{$value['banner_sort']}}</small></td>

                                    <td class="project-actions" style="text-align: center">
                                        <a href="/admin/banner/{{$value['id']}}/edit/"  class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 修改 </a>
                                        <span onclick="deletes(this,{{$value['id']}})"   class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 删除 </span>
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
<script>
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/banner/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        //判断是否成功
                        if(data['code']==1000){
                            //移除数据
                            tot = Number($('#tot').html());
                            $('#tot').html(--tot);
                            $(obj).parent().parent().remove();
                            layer.msg('删除成功');
                        }else {
                            layer.msg(data['msg']);
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
