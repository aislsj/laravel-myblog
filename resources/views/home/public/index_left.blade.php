<div class="sidebar">

    <div class="tuijian">
        <iframe src="https://cloud.mokeyjay.com/pixiv" frameborder="0"  style=" height:380px;"></iframe>
    </div>




    <div class="tuijian">
        <h2 class="hometitle">推荐文章与分享</h2>
        <ul class="sidenews">
            @foreach($re_article as $value)
                <li> @if($value->article_img_status == 1 )<i><img src=" {{$value->article_img_path}}"></i> @endif<p> <a href="/list/info/{{$value->id}}">{{$value->article_name}}</a></p><span>{{$value->article_addtime}}</span> </li>
            @endforeach
        </ul>
    </div>
    <div class="tuijian">
        <h2 class="hometitle">点击排行</h2>

        <ul class="sidenews">
            @foreach($click_article as $value)
                <li> @if($value->article_img_status == 1 )<i><img src=" {{$value->article_img_path}}"></i> @endif<p> <a href="/list/info/{{$value->id}}">{{$value->article_name}}</a></p><span>{{$value->article_addtime}}</span> </li>
            @endforeach
        </ul>
    </div>
    <div class="cloud">
        <h2 class="hometitle">标签云</h2>
        <ul>
            @foreach($lable as $value)
                <a href="{{$value->link}}">{{$value->name}}</a>
            @endforeach
        </ul>
    </div>
    <div class="link">
        <h2 class="hometitle">友情链接</h2>
        <ul>
            @foreach($amity_link as $value)
            <li><a href="{{$value->link}}" target="_blank">{{$value->title}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="guanzhu" id="follow-us">
        <h2 class="hometitle">关注我们 么么哒！</h2>
        <ul>
            <li class="qq"><a href="/" target="_blank"><span>QQ号</span>1971754369</a></li>
            <li class="email"><a href="/" target="_blank"><span>邮箱帐号</span>1971754369@qq.com</a></li>
            <li class="wxgzh"><a href="/" target="_blank"><span>微信号</span>a1971754369</a></li>
            <li class="wx"><img src=" /Style/home/images/wx.jpg"></li>
        </ul>
    </div>


</div>

</div>