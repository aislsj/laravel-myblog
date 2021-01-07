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


</head>

<body class="gray-bg">
<script>
    //记录当前页面url
    document.cookie="url=/admin/article";
</script>

<style>
</style>

<div class="wrapper wrapper-content animated fadeInUp">
    <div class="row">
        <div class="col-sm-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>所有商品博文</h5>
                    <div class="ibox-tools">
                        <span class="btn btn-primary btn-xs"><b id="tot">{{$tot}}</b>&nbsp;篇文章</span>
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
                                    <td class="col-md-2" style="text-align: center">标题</td>
                                    <td class="col-md-2" style="text-align: center">首页图</td>
                                    <td class="col-md-1" style="text-align: center">文章所属</td>
                                    <td class="col-md-1" style="text-align: center">是否推荐</td>
                                    <td class="col-md-1" style="text-align: center">是否发表</td>
                                    <td class="col-md-2" style="text-align: center"> 操作</td>
                                </tr>


                                @foreach($articles as $article)
                                    <tr>
                                        <td class="col-md-2" style="text-align: center">{{$article->article_name}}</td>

                                         @if ($article->article_img_status == 1)
                                            <td class="col-md-2" style="text-align: center"><img src="{{$article->article_img_path}}" style="width: 80px;"></td>
                                        @elseif ($article->article_img_status == 2)
                                            <td class="col-md-2" style="text-align: center">
                                                <?php
                                                    $arr = explode(',',$article->article_img_path);
                                                    foreach($arr as $img){
                                                        echo "<img src='$img' style='width: 75px; height: 50px;margin-left: 8px;'>";
                                                    }
                                                ?>
                                            </td>
                                        @elseif ($article->article_img_status == 3)
                                            <td class="col-md-2" style="text-align: center"><img src="{{$article->article_img_path}}" style="width: 120px;"></td>
                                        @else ($article->article_img_status == 4)
                                            <td class="col-md-2" style="text-align: center"></td>
                                        @endif

                                        <td class="col-md-1" style="text-align: center">{{$article->catename}}</td>
                                        <td class="col-md-1" style="text-align: center">
                                            @if($article->recommend == 1)推荐@endif
                                        </td>
                                        <td class="col-md-1" style="text-align: center">
                                            @if($article->article_status == 1)已发表@else未发表@endif
                                        </td>
                                        <td class="col-md-2" style="text-align: center">
                                            <span type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5" id="img_model" onClick="img_model({{$article->id}})">首页图类型</span>
                                            <a href="/admin/article/{{$article->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>编辑</a>
                                            <span  onclick="deletes(this,{{$article->id}})" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> 删除</span>
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
                            {{$articles->links()}}
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
<script src="/Style/admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<link href="/Style/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


<script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
<script src="{{asset('/Style/org/layer/layer.js')}}" type="text/javascript"></script>

<script>
    //ajax删除
    function deletes(obj,id){
        layer.confirm('你确定要删除这条数据吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("/admin/article/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        console.log(1);
                        console.log(data);
                        //判断是否成功
                        if(data==1){
                            //移除数据
                            tot = Number($('#tot').html());
                            $('#tot').html(--tot);
                            $(obj).parent().parent().remove();
                            layer.msg('删除成功');
                        }else {
                            console.log(1);
                            console.log(data);

                            layer.msg('删除失败')
                        }
                    })
        }, function(){
            layer.msg('取消操作');
        });
    }

    function img_model(id){
        $("#more_img").attr("href","article/more_img/"+id);
        $("#big_img").attr("href","article/big_img/"+id);
        $("#img").attr("href","article/img/"+id);
        $("#cancel_img").attr("href","article/cancel_img/"+id);

    }


</script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>
