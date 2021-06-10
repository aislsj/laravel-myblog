<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
我们需要用ajax 所以要引入线上的jquery
<html>
<head>
    <title></title>
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
</head>
<body>
@foreach($data as $value)
    <div style='float:left;margin-right:20px;'>
        <p>
            <span id="h{{$value->id}}"></span> 时
            <span id="m{{$value->id}}"></span> 分
            <span id="s{{$value->id}}"></span> 秒
        </p>

        <p><img src="{{$value->path}}" width='280' height='200'></p>
        <p>{{$value->name}}</p>
        <p>{{$value->price}}</p>
        <p><input type='button' value='抢购' id="{{$value->id}}"></p>
    </div>
@endforeach
</body>
</html>



<script>
    // 倒计时
    $(document).ready(function(){
        // 计时器
        window.setInterval(function(){
            $.ajax({
                url:'http://www.week12.com/daojishi',
                type:'get',
                dataType:'json',
                success:function(data){
                    for(var i=0;i<data.length;i++){
                        id=data[i]['id'];		// 商品ID
                        $('#h'+id).text(data[i]['hour']);
                        $('#m'+id).text(data[i]['minute']);
                        $('#s'+id).text(data[i]['second']);
                    }
                }
            });
        },1000);		// 每秒(1000毫米）执行一次代码

        // 抢购按钮加单击事件
        $("input[type=button]").click(function(){
            var id=$(this).attr('id');
            $.ajax({
                url:'http://www.week12.com/miaoshahou',
                type:'get',
                dataType:'json',
                data:{'id':id},
                success:function(data){
                    if(data['code']==1){
                        alert(data['msg']);
                    }else{
                        alert(data['msg']);
                    }
                }
            });
        });
    });
</script>
