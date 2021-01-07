<!DOCTYPE html>
<html>
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

    <link href="/Style/other/img_more/css/common.css" type="text/css" rel="stylesheet"/>
    <link href="/Style/other/img_more/css/index.css" type="text/css" rel="stylesheet"/>
    <script src="/Style/other/img_more/js/jquery.js"></script>

    <style>
        .droppable-active{background-color:#ffe!important}.tools a{cursor:pointer;font-size:80%}.form-body .col-md-6,.form-body .col-md-12{min-height:400px}.draggable{cursor:move}
        .checkbox input[type=checkbox], .checkbox-inline input[type=checkbox], .radio input[type=radio], .radio-inline input[type=radio]{margin-top: 2px}
    </style>

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="ibox-content">


                    <form role="form" action="/admin/article/more_img_save" method="post" enctype="multipart/form-data" class="form-horizontal m-t">

                        {{ csrf_field() }}


                        <input type="hidden" name="article_id"  value="<?php  echo $id ?>"  />


                        <div class="img-box full">
                            <section class=" img-section">
                                <p class="up-p"><span class="up-span">最多可以上传5张图片</span></p>
                                <div class="z_photo upimg-div clear" >

                                    <section class="z_file fl">
                                        <img src="/Style/other/img_more/img/a11.png" class="add-img">
                                        <input type="file" name="file" id="file" class="file" value="" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple />
                                    </section>
                                </div>
                            </section>
                        </div>
                        <aside class="mask works-mask">
                            <div class="mask-content">
                                <p class="del-p ">您确定要删除作品图片吗？</p>
                                <p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
                            </div>
                        </aside>




                            <div class="form-group draggable" style="margin-top: 50px">
                            <div class="col-sm-12 col-sm-offset-1">
                                <button class="btn btn-primary" type="submit" >确定</button>
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

<script src="/Style/admin/js/jquery-ui-1.10.4.min.js"></script>
<script src="/Style/admin/js/plugins/beautifyhtml/beautifyhtml.js"></script>
<script>
    $(document).ready(function(){$("#loading-example-btn").click(function(){btn=$(this);simpleLoad(btn,true);simpleLoad(btn,false)})});function simpleLoad(btn,state){if(state){btn.children().addClass("fa-spin");btn.contents().last().replaceWith(" Loading")}else{setTimeout(function(){btn.children().removeClass("fa-spin");btn.contents().last().replaceWith(" Refresh")},2000)}};
</script>


<script>
    $(function(){
        var delParent;
        var defaults = {
            fileType         : ["jpg","png","bmp","jpeg"],   // 上传文件的类型
            fileSize         : 1024 * 1024 * 10                  // 上传文件的大小 10M
        };
        /*点击图片的文本框*/
        $(".file").change(function(){
            var idFile = $(this).attr("id");
            var file = document.getElementById(idFile);
            var imgContainer = $(this).parents(".z_photo"); //存放图片的父亲元素
            var fileList = file.files; //获取的图片文件
            var input = $(this).parent();//文本框的父亲元素
            var imgArr = [];
            //遍历得到的图片文件
            var numUp = imgContainer.find(".up-section").length;
            var totalNum = numUp + fileList.length;  //总的数量
            if(fileList.length > 5 || totalNum > 5 ){
                alert("上传图片数目不可以超过5个，请重新选择");  //一次选择上传超过5个 或者是已经上传和这次上传的到的总数也不可以超过5个
            }
            else if(numUp < 5){
                fileList = validateUp(fileList);
                for(var i = 0;i<fileList.length;i++){
                    var imgUrl = window.URL.createObjectURL(fileList[i]);
                    imgArr.push(imgUrl);
                    var $section = $("<section class='up-section fl loading'>");
                    imgContainer.prepend($section);
                    var $span = $("<span class='up-span'>");
                    $span.appendTo($section);

                    var $input2
                    let data;
                    let blob = fileList[i];
                    let reader = new window.FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        data = reader.result;
                        $.ajax({
                            url: "/admin/upload",
                            type: "POST",
                            data: {"_token":'{{csrf_token()}}',"img":data},
                            dataType: "json",
                            success: function success(data) {

                                console.log(data)
                                $input2 = $("<input  name='tags[]' value='"+ data['path'] + "' type='hidden'/>");
                                $input2.appendTo($section);

                            }
                        });
                    }


                    var $img0 = $("<img class='close-upimg'>").on("click",function(event){
                        event.preventDefault();
                        event.stopPropagation();
                        $(".works-mask").show();
                        delParent = $(this).parent();
                    });
                    $img0.attr("src","/Style/other/img_more/img/a7.png").appendTo($section);
                    var $img = $("<img class='up-img up-opcity'>");
                    $img.attr("src",imgArr[i]);
                    $img.appendTo($section);
                    var $p = $("<p class='img-name-p'>");
                    $p.html(fileList[i].name).appendTo($section);

                }
            }
            setTimeout(function(){
                $(".up-section").removeClass("loading");
                $(".up-img").removeClass("up-opcity");
            },450);
            numUp = imgContainer.find(".up-section").length;
            if(numUp >= 5){
                $(this).parent().hide();
            }
        });



        $(".z_photo").delegate(".close-upimg","click",function(){
            $(".works-mask").show();
            delParent = $(this).parent();
        });

        $(".wsdel-ok").click(function(){
            $(".works-mask").hide();
            var numUp = delParent.siblings().length;
            if(numUp < 6){
                delParent.parent().find(".z_file").show();
            }
            delParent.remove();
        });

        $(".wsdel-no").click(function(){
            $(".works-mask").hide();
        });

        function validateUp(files){
            var arrFiles = [];//替换的文件数组
            for(var i = 0, file; file = files[i]; i++){
                //获取文件上传的后缀名
                var newStr = file.name.split("").reverse().join("");
                if(newStr.split(".")[0] != null){
                    var type = newStr.split(".")[0].split("").reverse().join("");
                    console.log(type+"===type===");
                    if(jQuery.inArray(type, defaults.fileType) > -1){
                        // 类型符合，可以上传
                        if (file.size >= defaults.fileSize) {
                            alert(file.size);
                            alert('您这个"'+ file.name +'"文件大小过大');
                        } else {
                            // 在这里需要判断当前所有文件中
                            arrFiles.push(file);
                        }
                    }else{
                        alert('您这个"'+ file.name +'"上传类型不符合');
                    }
                }else{
                    alert('您这个"'+ file.name +'"没有类型, 无法识别');
                }
            }
            return arrFiles;
        }



    })



</script>
</body>
</html>
