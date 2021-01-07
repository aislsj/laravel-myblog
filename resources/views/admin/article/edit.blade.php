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




    {{--百度编辑器--}}
    <script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/lang/zh-cn/zh-cn.js"></script>



    <!--时间插件-->
    <script src="/Style/admin/js/plugins/layer/laydate/laydate.js"></script>
    <!--时间插件-->

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
                    <h5>添加博文</h5>
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


                    <form role="form" action="/admin/article/{{$article->id}}" method="post"  class="form-horizontal m-t">


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
                            <label class="col-sm-1 control-label">文章标题：</label>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="col-sm-11">
                                <input type="hidden" name="id" class="form-control"  value="{{$article->id}}">

                                <input type="text" name="article_name" class="form-control" placeholder="请输入标题" value="{{$article->article_name}}">
                            </div>
                        </div>

                        <!--关键词-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章关键词：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_keywords" class="form-control" placeholder="请输入关键词" value="{{$article->article_keywords}}">
                            </div>
                        </div>

                        <!--描述-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章描述：</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" name="article_describe" placeholder="请输入文章描述" rows="8">{{$article->article_describe}}</textarea>
                            </div>
                        </div>




                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章分类：</label>

                            <div class="col-sm-11">
                            <select name="type_id" class="form-control" id="">
                                <option value="">请选择文章分类</option>
                                @foreach($types as $type)
                                        <option  value="{{$type->id}}"  @if($article->type_id==$type->id) selected="selected" @endif>{{$type->catename}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>



                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">是否推荐：
                            </label>
                            <div class="col-sm-11">
                                <label class="radio-inline"><input type="radio"  @if($article->recommend==0) checked="" @endif  value="0"  name="recommend">否</label>
                                <label class="radio-inline"><input type="radio"  @if($article->recommend==1) checked="" @endif  value="1"  name="recommend">是</label>
                            </div>
                        </div>

                        <!-- 文章上传功能---------------------------------------------------------------------------   -->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">文章图片：</label>
                            <div class="col-sm-11">
                                <button  type="button"  id="replaceImg" class="l-btn">更换图片</button>
                                <div style="width: 160px;margin-top: 10px">

                                    @if ($article->article_img_status == 1)
                                        <img id="finalImg" src="{{ URL::asset($article->article_img_path)}}" width="100%">
                                        <input type="text" id="article_img" name="article_img" value="{{$article->article_img_path}}" width="100%"  style="display: none">
                                    @else
                                        <img id="finalImg" src="" width="100%">
                                        <input type="text" id="article_img" name="article_img" value="" width="100%"  style="display: none">
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
                                            $("#article_img").attr("value",data['path']);
                                        }
                                    }
                                });
                            });
                        </script>
                        <!-- 文章上传功能----------------------------------------------------------------------------->



                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章内容：</label>
                            <div class="col-sm-11">
                                <textarea id="editor" name="article_content" type="text/plain"  style="width:100%;height:500px">{{$article->content}}</textarea>
                            </div>
                        </div>

                        <!--文章作者-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章作者：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_author" class="form-control" placeholder="请输入作者" value="{{$article->article_author}}">
                            </div>
                        </div>


                        <!--文章作者-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章来源：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_url" class="form-control" placeholder="请输入文章来源,没有可为空" value="{{$article->article_url}}">
                            </div>
                        </div>



                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">是否发布：
                            </label>
                            <div class="col-sm-11">
                                <label class="radio-inline">
                                    <input type="radio"  @if($article->article_status==1) checked="" @endif  value="1" id="optionsRadios1" name="article_status">直接发布</label>
                                <label class="radio-inline">
                                    <input type="radio"  @if($article->article_status==0) checked="" @endif value="0" id="optionsRadios2" name="article_status">保存内容但不发布</label>
                            </div>
                        </div>



                        <!--发布时间-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">撰写时间：</label>
                            <div class="col-sm-11">
                                <input id="hello" name="article_addtime" class="laydate-icon form-control layer-date" value="{{$article->article_addtime}}">
                            </div>
                        </div>
                        <script>
                            laydate({elem:"#hello",event:"focus"});var start={elem:"#start",format:"YYYY/MM/DD hh:mm:ss",min:laydate.now(),max:"2099-06-16 23:59:59",istime:true,istoday:false,choose:function(datas){end.min=datas;end.start=datas}};var end={elem:"#end",format:"YYYY/MM/DD hh:mm:ss",min:laydate.now(),max:"2099-06-16 23:59:59",istime:true,istoday:false,choose:function(datas){start.max=datas}};//laydate(start);laydate(end);
                        </script>
                        <!--发布时间-->




                        <div class="form-group draggable">
                            <div class="col-sm-12 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit">确认修改</button>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="/Style/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/Style/admin/js/content.min.js?v=1.0.0"></script>
<script src="/Style/admin/js/jquery-ui-1.10.4.min.js"></script>
<script src="/Style/admin/js/plugins/beautifyhtml/beautifyhtml.js"></script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>


<script type="text/javascript">
    var ue = UE.getEditor('editor');
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }
</script>
</body>


</html>
