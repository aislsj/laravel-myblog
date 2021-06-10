
@extends('admin.base')


@section('content')

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            layer.alert('{{$error}}', {icon: 2});
        </script>
    @endforeach
@endif

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
                                <td class="project-status center">标签类型</td>
                                <td class="project-actions" style="text-align: center">操作</td>
                            </tr>

                            @foreach($data as $value)
                                <tr>
                                    <td class="project-completion center"><small></small></td>
                                    <td class="project-completion center"><small>{{$value['name']}}</small></td>
                                    <td class="project-completion center"><small>{{$value['link']}}</small></td>
                                    <td class="project-completion center"><small>{{$value['type']}}</small></td>
                                    <td class="project-actions" style="text-align: center">
                                        <span onclick="deletes(this,{{$value['id']}})"   class="btn btn-white btn-sm"><i class="fa fa-folder"></i> 删除 </span>
                                    </td>
                                </tr>
                            @endforeach



                            <form action="/admin/lable"  role="form" enctype="multipart/form-data"  class="form-horizontal m-t"  method="post" >
                                {{csrf_field()}}
                                <tr>
                                    <td class="project-completion center"><small> <span class="btn btn-primary btn-xs">新增标签</span></small></td>
                                    <td class="project-completion center"><small><input type="text" name="name"></small></td>
                                    <td class="project-completion center"><small><input type="text" name="link"></small></td>
                                    <td class="project-completion center"><small><input type="text" name="type"></small></td>
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

@endsection







@section('script')

<script>
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/lable/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        if(data['code']==1000){
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
