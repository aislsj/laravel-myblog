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
                <h5>修改管理员</h5>
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
                <form action="/admin/admin/{{$data->id}}"  enctype="multipart/form-data" class="form-horizontal m-t" id="signupForm" method="post">


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





                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名：</label>
                        <div class="col-sm-8">
                            <input id="username" disabled value="{{$data->name}}" name="name" class="form-control" type="text" aria-required="true" aria-invalid="true" class="error">
                        </div>
                    </div>

                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id"       value="{{$data->id}}" >
                    <input type="hidden" name="_token"  value="{{csrf_token()}}"/>






                        <!-- 图片上传功能---------------------------------------------------------------------------   -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">文章图片：</label>
                            <div class="col-sm-8">
                                <button  type="button"  id="replaceImg" class="l-btn">更换图片</button>
                                <div style="width: 100px;margin-top: 10px">

                                    @if ($data->admin_img)
                                        <img id="finalImg" src="{{ URL::asset($data->admin_img)}}" width="100%" style="border-radius: 60px">
                                        <input type="text" id="admin_img" name="admin_img" value="{{$data->admin_img}}" width="100%"  style="display: none;">
                                    @else
                                        <img id="finalImg" src="" width="100%" style="border-radius: 60px">
                                        <input type="text" id="admin_img" name="admin_img" value="" width="100%"  style="display: none">
                                    @endif
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
                                        <img id="tailoringImg">
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
                        <!-- 图片上传插件   -->
                        <link rel="stylesheet" href="/Style/upload_img/css/cropper.min.css">
                        <link rel="stylesheet" href="/Style/upload_img/css/ImgCropping.css">
                        <script type="text/javascript" src="/Style/upload_img/js/jquery.min.js"></script>
                        <script type="text/javascript" src="/Style/upload_img/js/cropper.min.js"></script>
                        <!-- 图片上传插件   -->
                        <script type="text/javascript">
                            //弹出框水平垂直居中
                            (window.onresize = function () {
                                var win_height = $(window).height();
                                var win_width = $(window).width();
                                if (win_width <= 768){
                                    $(".tailoring-content").css({
                                        "top": (win_height - $(".tailoring-content").outerHeight())/2,
                                        "left": 0
                                    });
                                }else{
                                    $(".tailoring-content").css({
                                        "top": (win_height - $(".tailoring-content").outerHeight())/2,
                                        "left": (win_width - $(".tailoring-content").outerWidth())/2
                                    });
                                }
                            })();
                            //弹出图片裁剪框
                            $("#replaceImg").on("click",function () {
                                $(".tailoring-container").toggle();
                            });
                            //图像上传
                            function selectImg(file) {
                                if (!file.files || !file.files[0]){
                                    return;
                                }
                                var reader = new FileReader();
                                reader.onload = function (evt) {
                                    var replaceSrc = evt.target.result;
                                    //更换cropper的图片
                                    $('#tailoringImg').cropper('replace', replaceSrc,false);//默认false，适应高度，不失真
                                }
                                reader.readAsDataURL(file.files[0]);
                            }
                            //cropper图片裁剪
                            $('#tailoringImg').cropper({
                                aspectRatio: 1/1,//默认比例
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
                            //旋转
                            $(".cropper-rotate-btn").on("click",function () {
                                $('#tailoringImg').cropper("rotate", 45);
                            });
                            //复位
                            $(".cropper-reset-btn").on("click",function () {
                                $('#tailoringImg').cropper("reset");
                            });
                            //换向
                            var flagX = true;
                            $(".cropper-scaleX-btn").on("click",function () {
                                if(flagX){
                                    $('#tailoringImg').cropper("scaleX", -1);
                                    flagX = false;
                                }else{
                                    $('#tailoringImg').cropper("scaleX", 1);
                                    flagX = true;
                                }
                                flagX != flagX;
                            });
                            //裁剪后的处理
                            $("#sureCut").on("click",function () {
                                if ($("#tailoringImg").attr("src") == null ){
                                    return false;
                                }else{
                                    var cas = $('#tailoringImg').cropper('getCroppedCanvas');//获取被裁剪后的canvas
                                    var base64url = cas.toDataURL('image/png'); //转换为base64地址形式
                                    $("#finalImg").prop("src",base64url);//显示为图片的形式

                                    //关闭裁剪框
                                    closeTailor();
                                }
                            });
                            //关闭裁剪框
                            function closeTailor() {
                                $(".tailoring-container").toggle();
                            }
                            //保存截图
                            document.getElementById('sureCut').addEventListener('click', function () {
                                var avatar = document.getElementById('finalImg');
                                var initialAvatarURL;
                                initialAvatarURL = avatar.src;
                                $.ajax({
                                    url: "/admin/upload",
                                    method: "POST",
                                    data: {"_token":'{{csrf_token()}}','img':initialAvatarURL},
                                    dataType: "json",
                                    success: function success(data) {
                                        if(data['data']==1){
                                            $("#admin_img").attr("value",data['path']);
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- 图片上传功能----------------------------------------------------------------------------->





                        <div class="form-group">
                    <label class="col-sm-3 control-label">权限：</label>
                    <div class="col-sm-8">
                        <input id="identity" value="{{$data->identity}}" name="identity" class="form-control" type="text">
                        {{--<select name="group_id">--}}
                    {{--{volist name="re" id="authgroup"}--}}
                    {{--<option value="{$authgroup.id}">{$authgroup.title}</option>--}}
                    {{--{/volist}--}}
                    {{--</select>--}}
                    </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">密码：</label>
                        <div class="col-sm-8">
                            <input id="password" value="{{$data->pass}}" name="pass" class="form-control" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认密码：</label>
                        <div class="col-sm-8">
                            <input id="confirm_password" value="{{$data->pass}}" name="check_pass" class="form-control" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">状态：</label>
                        @if($data->admin_status)
                            <div class="col-sm-8">
                                <input type="radio" name="admin_status" value="1" checked>启用
                                <input type="radio" name="admin_status"  value="0" >停用
                            </div>
                        @else
                            <div class="col-sm-8">
                                <input type="radio" name="admin_status" value="1"  >启用
                                <input type="radio" name="admin_status" value="0"  checked>停用
                            </div>
                         @endif

                    </div>

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


<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Style/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>


</html>
