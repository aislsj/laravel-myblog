<!DOCTYPE html>
<html>


<!-- Mirrored from www.zi-han.net/theme/hplus/form_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:15 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 基本表单</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Style/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">




    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>修改轮播图</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                        <i class="fa fa-wrench"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form action="/admin/sys/slider/{{$data->id}}" role="form" enctype="multipart/form-data"  class="form-horizontal m-t"  method="post" >


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


                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" value="{{$data->id}}" name="id">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">轮播图名称</label>
                        <div class="col-sm-8">
                            <input id="username" name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error" value="{{$data->title}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">友情链接</label>
                        <div class="col-sm-8">
                            <input  name="href" class="form-control" type="text" value="{{$data->href}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">排序</label>
                        <div class="col-sm-8">
                            <input  name="orders" class="form-control" type="text" value="{{$data->orders}}">
                        </div>
                    </div>


                    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                    <script src="{{asset('/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{asset('/org/uploadify/uploadify.css')}}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">图片</label>
                        <div class="col-sm-8">
                            <div class="col-sm-8">
                                <input id="file_upload" name="file_upload" type="file" multiple="true">
                                <input id="img" value="{{$data->img}}" type="hidden" name="img">
                                <img id="picshow" src="{{$data->img}}" style="width:200px">
                            </div>

                        </div>
                    </div>
                    <script type="text/javascript">
                            $('#file_upload').uploadify({
                                formData     : {
                                    token     : '{{csrf_token()}}' // Laravel表单提交必需参数_token，防止CSRF
                                },
                                swf      : '{{asset('/org/uploadify/uploadify.swf')}}',// 引入Uploadify 的核心Flash文件--}}
                                uploader : "{{url('/admin/upload')}}",// PHP脚本地址
{{--                            buttonImage: "{{asset('org/uploadify/uploadify-btn.png')}}", // 上传按钮背景图片地址--}}
                                fileTypeDesc: 'Image File', // 选择文件对话框中图片类型提示文字（Windows系统）
                                fileTypeExts: '*.jpg;*.jpeg;*.png;*.gif', // 选择文件对话框中允许选择的文件类型（Windows系统）
                                onUploadSuccess : function(file, data, response) { // 上传成功回调函数
                                    $('#picshow').attr('src', data).show();
                                    $('#file_upload,#img').val(data);
                                },
                                onUploadError: function(file, errorCode, errorMsg, errorString) { // 上传失败回调函数
                                    $('#picshow').attr('src', '').hide();
                                    $('#file_upload').val('');
                                    alert('上传失败，请重试！');
                                }
                            });
                    </script>


                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                            <button class="btn btn-primary" type="reset">重置</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>


<script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Style/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>


</html>














