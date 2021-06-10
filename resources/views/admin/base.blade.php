<!DOCTYPE html>
<html>
<style>
    .center{text-align: center;}
</style>
<head>
    <meta charset="utf-8">
    <title></title>
    <title>{{config('app.name')}}博客管理系统</title>
    <link rel="shortcut icon" > <link href="/Style/admin/css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/Style/admin/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/Style/admin/css/animate.min.css" rel="stylesheet">
    <link href="/Style/admin/css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <script src="/Style/admin/js/plugins/layer/laydate/laydate.js"></script>
    <script src="/Style/admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="{{asset('/Style/org/layer/3.1.1/layer.js')}}" type="text/javascript"></script>

    @yield('style')
    <style>
        .center{text-align: center}
    </style>
    @section('css')

    @show
</head>
<body >

{{--引入公共模板--}}
@section('header')

@show
<!--内容-->
<div class="content">

    @section('content')

    @show
</div>

@section('script')

@show

<div class="footer">

    @section('footer')

    @show

</div>

</body>
</html>

