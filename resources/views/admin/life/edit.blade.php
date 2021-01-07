<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/form_builder.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:19 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台管理系统</title>
    <link rel="shortcut icon" href="favicon.ico"> <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/Style/admin/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">




    <style>
        .droppable-active{background-color:#ffe!important}.tools a{cursor:pointer;font-size:80%}.form-body .col-md-6,.form-body .col-md-12{min-height:400px}.draggable{cursor:move}
    </style>

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>修改分类</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <form role="form" action="/admin/life/{{$data->id}}"enctype="multipart/form-data" class="form-horizontal m-t"  method="post">


                    @if ($errors->any())
                        <div class="form-group">
                            <label class="col-sm-3 control-label">错误提示：</label>
                            <div class="col-sm-8 alert alert-danger">
                                <ul class="list-inline" style="line-height: 30px;">
                                    @foreach ($errors->all() as $error)
                                        <li >{{ $error }}</li><br/>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif



                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">分类名称：</label>


                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" value="{{$data->id}}" name="id">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                            <div class="col-sm-9">
                                <input type="text" name="catename" class="form-control" placeholder="请输入分类名 " value="{{$data->catename}}">
                            </div>
                        </div>





                        <div class="form-group draggable">
                            <label class="col-sm-3 control-label">排序：</label>
                            <div class="col-sm-9">
                                <input type="text"  value="{{$data->sort}}" name="sort" class="form-control" placeholder="排序 " onkeyup="value=value.replace(/[^\d]/g,'')">
                            </div>
                        </div>


                        <div class="form-group draggable">
                            <div class="col-sm-12 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">修改分类</button>
                                <button class="btn btn-white" type="submit">取消</button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Style/admin/js/jquery-ui-1.10.4.min.js"></script>
<script src="/Style/admin/js/plugins/beautifyhtml/beautifyhtml.js"></script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>
