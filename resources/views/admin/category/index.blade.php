@extends('admin.base')

@section('content')
    <style>
        #nestable .dd-item >.dd-update::before{content:"编辑";width: 40px;height: 30px;line-height: 30px;top: -0px;border-radius: 2px;color: orange;}
        #nestable .dd-item >.dd-delete::before{content:"删除";width: 40px;height: 30px;line-height: 30px;top: -0px;border-radius: 2px;color: red;}
        button.dd-update{position: absolute;top: 0;right: 50px;}
        button.dd-delete{position: absolute;top: 0;right: 0;}
        .dd-update{width: 40px;height: 30px;}
        .dd-delete{width: 40px;height: 30px;}
    </style>
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-sm-4">
                <div id="nestable-menu">
                    <button type="button" data-action="expand-all" class="btn btn-white btn-sm">展开所有</button>
                    <button type="button" data-action="collapse-all" class="btn btn-white btn-sm">收起所有</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>分类</h5>
                        <div class="ibox-tools">
                            <a href="/admin/category/create" class="btn btn-primary btn-xs">新增分类</a>
                            <a href="javascript:void(0);" onclick="CategorySort()" class="btn btn-primary btn-xs">重置排序</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <p class="m-b-lg">
                            目前只支持二级分类，超出部分会报错
                        </p>
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                            @foreach($data as $value)
                                <li class="dd-item" data-id="{{$value['id']}}">
                                <div class="dd-handle"><span class="label label-info"></span> {{$value['name']}}</div>
                                <button class="dd-update" onclick="CategoryEdit({{$value['id']}})" style="width: 40px;height: 32px;margin: 0"></button>
                                <button class="dd-delete" onclick="del({{$value['id']}})" style="width: 40px;height: 32px;margin: 0"></button>
                                    @if(isset($value['son']))
                                        <ol class="dd-list">
                                            @foreach($value['son'] as $value)
                                                <li class="dd-item" data-id="{{$value['id']}}">
                                                    <div class="dd-handle"><span class="label label-info"></span> {{$value['name']}}</div>
                                                    <button class="dd-update" onclick="CategoryEdit({{$value['id']}})" style="width: 40px;height: 32px;margin: 0"></button>
                                                    <button class="dd-delete" onclick="del({{$value['id']}})" style="width: 40px;height: 32px;margin: 0"></button>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach
                            </ol>
                        </div>
                        <div class="m-t-md">
                            <h5>数据：</h5>
                        </div>
                        <textarea id="nestable-output" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/Style/admin/js/plugins/nestable/jquery.nestable.js"></script>

    <script>
        $(document).ready(function(){
            var updateOutput=function(e){
                var list=e.length?e:$(e.target),
                    output=list.data("output");
                if(window.JSON){
                    output.val(window.JSON.stringify(list.nestable("serialize")))
                }else{output.val("浏览器不支持")}
            };
            $("#nestable").nestable({group:1}).on("change",updateOutput);
            updateOutput($("#nestable").data("output",$("#nestable-output")));
            $("#nestable-menu").on("click",function(e){
                var target=$(e.target),action=target.data("action");
                if(action==="expand-all"){
                    $(".dd").nestable("expandAll")
                }if(action==="collapse-all"){
                    $(".dd").nestable("collapseAll")
                }
            })});
    </script>


    <script>
        function CategoryEdit(id){
            window.location.href="/admin/category/"+id+"/edit/";
        }
        function del(id){
            layer.confirm('你确定要删除这条分类吗', {
                btn: ['确定','取消']
            }, function(){
                $.post("/admin/category/"+id,{"_token":'{{csrf_token()}}',"_method":"delete"},
                    function(data){
                        if(data['code']==1000){
                            location.reload()
                        }
                        layer.msg(data['msg']);
                    })
            }, function(){
                layer.msg('取消操作');
            });
        }

        function  CategorySort(){
            var data = $('#nestable-output').val()
            $.ajax({
                url: "/admin/category/sort",
                method: "POST",
                data: {"_token":'{{csrf_token()}}','data':data},
                dataType: "json",
                success: function success(data) {
                    if(data['code']==1000){
                        layer.msg('更新成功');
                        location.reload()
                    }else {
                        layer.msg(data['msg']);

                    }
                }
            });
        }
    </script>
@endsection

