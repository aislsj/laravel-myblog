
@extends('admin.base')


@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>首页推荐</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form action="/admin/rmend" role="form" enctype="multipart/form-data"  class="form-horizontal m-t"  method="post" >

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
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">特别推荐标题</label>
                        <div class="col-sm-8">
                            <input id="title" name="title" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>


                        <!-- 图片上传功能---------------------------------------------------------------------------   -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">封面图：</label>
                            <div class="col-sm-8">
                                <button  type="button"  id="replaceImg" class="l-btn">更换图片</button>
                                <div style="width: 300px;margin-top: 10px">
                                    <img id="finalImg" src="" width="100%" >
                                    <input type="text" id="img_auth" name="img_auth" value="" width="100%"  style="display: none">
                                </div>
                            </div>
                        </div>

                        <!--图片裁剪框 start-->
                        <div style="display: none" class="tailoring-container">
                            <div class="black-cloth" onClick="closeTailor(this)"></div>
                            <div class="tailoring-content">
                                <div class="tailoring-content-one">
                                    <label title="上传图片" for="chooseImg" class="l-btn choose-btn">
                                        <input type="file" accept="image/jpg,image/jpeg,image/png" name="file" id="chooseImg" class="hidden" onChange="selectImg(this)">
                                        选择图片
                                    </label>
                                    <div class="close-tailoring"  onclick="closeTailor(this)">×</div>
                                </div>
                                <div class="tailoring-content-two">
                                    <div class="tailoring-box-parcel">
                                        <img id="tailoringImg" >
                                    </div>
                                    <div class="preview-box-parcel">
                                        <p>图片预览：</p>
                                        <div class="square previewImg"></div>
                                        <div class="circular previewImg"></div>
                                    </div>
                                </div>
                                <div class="tailoring-content-three">
                                    <button  type="button" class="l-btn cropper-reset-btn">复位</button>
                                    <button  type="button" class="l-btn cropper-rotate-btn">旋转</button>
                                    <button  type="button" class="l-btn cropper-scaleX-btn">换向</button>
                                    <button  type="button" class="l-btn sureCut" id="sureCut">确定</button>
                                </div>
                            </div>
                        </div>
                        <!--图片裁剪框 end-->


                    <div class="form-group">
                        <label class="col-sm-3 control-label">文章链接（输入文章ID）</label>
                        <div class="col-sm-8">

                            <input id="article_id" name="article_id" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">

                        </div>
                    </div>






                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>

@endsection


@section('script')

<link rel="stylesheet" href="/Style/upload_img/css/cropper.min.css">
<link rel="stylesheet" href="/Style/upload_img/css/ImgCropping.css">
<script type="text/javascript" src="/Style/upload_img/js/cropper.min.js"></script>
<script src="/Style/admin/js/uploadImage.js"></script>

<script>
    document.getElementById('sureCut').addEventListener('click', function () {
        var avatar = document.getElementById('finalImg');
        var initialAvatarURL;
        initialAvatarURL = avatar.src;
        $.ajax({
            url: "/admin/uploadImage",
            method: "POST",
            data: {"_token":'{{csrf_token()}}','img':initialAvatarURL,'type':'remend'},
            dataType: "json",
            success: function success(data) {
                if(data['code']==200){
                    $("#img_auth").attr("value",data['data']['src']);
                }
            }
        });
    });
    //cropper图片裁剪
    $('#tailoringImg').cropper({
        aspectRatio: 1.6/1,//默认比例
        preview: '.previewImg',//预览视图
        guides: false,  //裁剪框的虚线(九宫格)
        autoCropArea: 0.5,  //0-1之间的数值，定义自动剪裁区域的大小，默认0.8
        movable: false, //是否允许移动图片
        dragCrop: true,  //是否允许移除当前的剪裁框，并通过拖动来新建一个剪裁框区域
        movable: true,  //是否允许移动剪裁框
        resizable: true,  //是否允许改变裁剪框的大小
        zoomable: false,  //是否允许缩放图片大小
        mouseWheelZoom: true,  //是否允许通过鼠标滚轮来缩放图片
        touchDragZoom: true,  //是否允许通过触摸移动来缩放图片
        rotatable: true,  //是否允许旋转图片
        crop: function(e) {
            // 输出结果数据裁剪图像。
        }
    });
</script>



<script type="text/javascript" src="{{ asset('/Style/home/layui/layui.all.js') }}"></script>
<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Style/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

@endsection













