
@include('home/public/header')

<div class="pagebg timer"> </div>
<div class="container">
    <h1 class="t_nav"><span>时光飞逝，机会就在我们眼前，何时找到了灵感，就要把握机遇，我们需要智慧和勇气去把握机会。</span><a href="/" class="n1">网站首页</a><a href="/time" class="n2">时间轴</a></h1>
    <div class="timebox">
        <ul id="list" >
            @foreach($article as $data)
                <li><span>{{$data->article_addtime}}</span><a href="/article/{{$data->id}}" title="{{$data->article_name}}">{{$data->article_name}}</a></li>

            @endforeach

        </ul>

    </div>
</div>

<style>
    .pagelist{}
    .pagelist ul{display: inline-block;text-align: center;}
    .pagelist .pagination li{ display: inline;}
    .active,.disabled{border: 1px solid #000;margin: 0 2px;padding: 5px 10px}
</style>

    <div class="pagelist">
        {{$article->links()}}
    </div>

@include('home/public/fotter')

