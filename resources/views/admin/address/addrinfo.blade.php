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
                <h5>订单详情</h5>
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
                <form action=""  enctype="multipart/form-data" class="form-horizontal m-t" id="signupForm">

                    @foreach($data as $value)
                    <div class="form-group">
                        <label class="col-sm-3 control-label">订单号：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->code}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">下单时间：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{date('Y-m-d H:i:s',$value->time)}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">商品名称：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->title}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">商品数量/价格：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->num}}&nbsp;&nbsp;/&nbsp;&nbsp;{{$value->price}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">商品总价格：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->num*$value->price}}</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">客户名称：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->name}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">邮寄地址：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->addr}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">邮寄详细地址：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->addrinfo}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">邮寄收款人：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->sname}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">收款人电话：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->stel}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">商品图片：</label>
                        <div class="col-sm-8">
                            <img src="{{$value->img}}" style="width: 150px">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">订单状态：</label>
                        <div class="col-sm-8">
                            <span  class="form-control" type="text">{{$value->ssname}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <a href="/admin/addr" class="btn btn-primary" type="submit">返回订单列表</a>
                        </div>
                    </div>

                        @endforeach
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
