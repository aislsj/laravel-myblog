

@extends('admin.base')


@section('content')
    <div class="wrapper wrapper-content animated fadeInUp">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>所有博文</h5>
                        <div class="ibox-tools">
                            <a href="/admin/article/create" class="btn btn-primary btn-xs">撰写博文</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-1">
                                <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                            </div>
                            <div class="col-md-11">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入文章名称" class="input-sm form-control">
                                    <span class="input-group-btn"><button type="button" class="btn btn-sm btn-primary">搜索</button></span>
                                </div>
                            </div>
                        </div>



                        <div class="project-list">
                            <form action="1" method="post">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td class="col-md-2 center" >id</td>
                                        <td class="col-md-2 center" >标题</td>
                                        <td class="col-md-2 center" >首页图</td>
                                        <td class="col-md-1 center" >文章所属</td>
                                        <td class="col-md-1 center" >是否推荐</td>
                                        <td class="col-md-1 center" >是否发表</td>
                                        <td class="col-md-2 center" > 操作</td>
                                    </tr>
                                    @foreach($data as $article)
                                        <tr>
                                            <td class="col-md-2 center" >{{$article['id']}}</td>
                                            <td class="col-md-2 center" >{{$article['article_name']}}</td>
                                            <td class="col-md-2 center">
                                                @if ($article['article_img_status_name'] == '普通图片')
                                                    @foreach($article['articleImg'] as $article_img)
                                                        <img src='{{$article_img['article_image_path']}}' style='width: 80px;' >
                                                    @endforeach
                                                @elseif ($article['article_img_status_name'] == '多张图片')
                                                    @foreach($article['articleImg'] as $article_img)
                                                        <img src='{{$article_img['article_image_path']}}'  style='width: 75px; height: 50px;margin-left: 8px;'>
                                                    @endforeach
                                                @elseif ($article['article_img_status_name'] == '大图片')
                                                    @foreach($article['articleImg'] as $article_img)
                                                        <img src='{{$article_img['article_image_path']}}' style="width: 120px;">
                                                    @endforeach
                                                @elseif ($article['article_img_status_name'] == '没有图片')
                                                       {{$article['article_img_status_name']}}
                                                @endif
                                            </td>
                                            <td class="col-md-1 center" >{{$article['articleCategory']['name']}}</td>
                                            <td class="col-md-1 center" >{{$article['recommend']}}</td>
                                            <td class="col-md-1 center" >{{$article['article_status']}}</td>
                                            <td class="col-md-2 center" >
                                                <span type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5" id="img_model" onClick="img_model({{$article['id']}})">首页图类型</span>
                                                <a href="/admin/article/{{$article['id']}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>编辑</a>
                                                <span  onclick="deletes(this,{{$article['id']}})" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> 删除</span>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </form>


                            <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">首页图类型</h4>
                                            <small class="font-bold">这里可以修改你的封面图类型应用于首页</small>
                                        </div>
                                        <div class="modal-body">
                                            <div><a href="" id="more_img">多图片</a></div>
                                            <div><a href="" id="big_img">大图片</a></div>
                                            <div><a href="" id="img">正常图片</a></div>
                                            <div><a href="" id="cancel_img">不显示图片</a></div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{--分页效果--}}
                            <div class="panel-footer">
                                {{ $data->links() }}
                            </div>
                            {{--分页效果end--}}

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
    <script src="/Style/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
    <link href="/Style/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>
    <script>
        function deletes(obj,id){
            layer.confirm('你确定要删除这条数据吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("/admin/article/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        if(data['code']==1000){
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
        // 0:没有图片,1:普通图片,2:多张图片,3:大图片
        function img_model(id){
            $("#more_img").attr("href","article/addArticleImg?type=2&article_id="+id);
            $("#big_img").attr("href","article/addArticleImg?type=3&article_id="+id);
            $("#img").attr("href","article/addArticleImg?type=1&article_id="+id);
            $("#cancel_img").attr("href","article/addArticleImg?type=0&article_id="+id);

        }
    </script>

@endsection


