@extends('admin.base')


@section('content')
    <style>
        .droppable-active{background-color:#ffe!important}.tools a{cursor:pointer;font-size:80%}.form-body .col-md-6,.form-body .col-md-12{min-height:400px}.draggable{cursor:move}
        .checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-top: 2px}
    </style>


<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>添加博文</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form role="form" action="/admin/article" method="post" enctype="multipart/form-data" class="form-horizontal m-t">
                        @if ($errors->any())
                            <div class="form-group">
                                <label class="col-sm-1 control-label">错误提示：</label>
                                <div class="col-sm-11 alert alert-danger">
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
                            {{csrf_field()}}
                            <div class="col-sm-11">
                                <input type="text" name="article_name" class="form-control" placeholder="请输入标题">
                            </div>
                        </div>

                        <!--关键词-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章关键词：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_keywords" class="form-control" placeholder="请输入关键词">
                            </div>
                        </div>

                        <!--描述-->
                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章描述：</label>
                            <div class="col-sm-11">
                                <textarea class="form-control" name="article_describe" placeholder="请输入文章描述" rows="8"></textarea>
                            </div>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章分类：</label>
                            <div class="col-sm-11">
                            <select name="category_id" class="form-control" id="">
                                <option value="">请选择文章分类</option>
                                    @foreach($category as $data)
                                        <option value="{{$data['id']}}" @if(!$data['level']) disabled style="color: red" @endif>
                                            <?php echo str_repeat('------', $data['level']);?>{{$data['name']}}
                                        </option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">是否推荐：
                            </label>
                            <div class="col-sm-11">
                                <label class="radio-inline"><input type="radio" value="0"  name="recommend" checked="" >否</label>
                                <label class="radio-inline"><input type="radio" value="1"  name="recommend"            >是</label>
                            </div>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章内容：</label>
                            <div class="col-sm-11">
                                <script id="editor" name="article_content" type="text/plain"  style="width:100%;height:500px"></script>
                            </div>
                        </div>

                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章作者：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_author" class="form-control" placeholder="请输入作者">
                            </div>
                        </div>



                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">文章来源：</label>
                            <div class="col-sm-11">
                                <input type="text" name="article_url" class="form-control" placeholder="请输入文章来源,没有可为空">
                            </div>
                        </div>


                        <div class="form-group draggable">
                            <label class="col-sm-1 control-label">是否发布：
                            </label>
                            <div class="col-sm-11">
                                <label class="radio-inline">
                                    <input type="radio" checked="" value="1" id="optionsRadios1" name="article_status">直接发布</label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" id="optionsRadios2" name="article_status">保存内容但不发布</label>
                            </div>
                        </div>
                        <div class="form-group draggable">
                            <div class="col-sm-12 col-sm-offset-1">
                                <button class="btn btn-primary" type="submit">确定</button>
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



@endsection


@section('script')
<script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Style/baidu/ueditor/lang/zh-cn/zh-cn.js"></script>


<link rel="stylesheet" href="/Style/upload_img/css/cropper.min.css">
<link rel="stylesheet" href="/Style/upload_img/css/ImgCropping.css">
<script type="text/javascript" src="/Style/upload_img/js/cropper.min.js"></script>
<script src="/Style/admin/js/uploadImage.js"></script>

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
<script type="text/javascript">
    document.getElementById('sureCut').addEventListener('click', function () {
        var avatar = document.getElementById('finalImg');
        var initialAvatarURL;
        initialAvatarURL = avatar.src;

        $.ajax({
            url: "/admin/uploadImage",
            method: "POST",
            data: {"_token":'{{csrf_token()}}','img':initialAvatarURL},
            dataType: "json",
            success: function success(data) {
                if(data['data']==1){
                    $("#img").attr("value",data['path']);
                }
            }
        });
    });



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
@endsection
