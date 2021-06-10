
@include('home/public/header')


<div class="pagebg sh"></div>
<div class="container">
    <h1 class="t_nav"><span>不要轻易放弃。学习成长的路上，我们长路漫漫，只因学无止境。 </span><a href="/" class="n1">网站首页</a>
        <a href="/category/{{$category['id']}}" class="n2">{{$category['name']}}</a>
    </h1>
    <!--blogsbox begin-->
    <div class="blogsbox">

    @foreach($article as $value)
            <div class="blogs" data-scroll-reveal="enter bottom over 1s" >
                <h3 class="blogtitle"><a href="/category/info/{{$value['id']}}" >{{$value['article_name']}}</a></h3>

                @if ($article['article_img_status_name'] == '普通图片')
                    @foreach($article['articleImg'] as $article_img)
                        <span class="blogpic"><a href="/" title=""><img src="{{$article['article_image_path']}}" alt=""></a></span>
                    @endforeach
                @elseif ($article['article_img_status_name'] == '多张图片')
                    <span class="bplist">
                        <a href="/" title="">
                            @foreach($article['articleImg'] as $article_img)
                                <li><img src={{$article_img['article_image_path']}} alt="" ></li>
                            @endforeach
                        </a>
                    </span>
                @elseif ($article['article_img_status_name'] == '大图片')
                    @foreach($article['articleImg'] as $article_img)
                        <span class="bigpic"><a href="/" title=""><img src="{{$article_img['article_img_path']}}" alt=""></a></span>
                    @endforeach
                @endif

                <p class="blogtext">{{$value['article_describe']}}</p>
                <div class="bloginfo">
                    <ul>
                        <li class="author"><a href="/">{{$value['article_author']}}</a></li>
                        <li class="lmname"><a href="/">{{$value['article_keywords']}}</a></li>
                        <li class="timer">{{$value['article_addtime']}}</li>
                        <li class="view"><span>{{$value['article_reply']}}</span>条评论</li>
                        <li class="like">{{$value['article_praise']}}</li>
                    </ul>
                </div>
            </div>
    @endforeach


        <style>
            .pagelist{}
            .pagelist ul{display: inline-block;text-align: center;}
            .pagelist .pagination li{ display: inline;}
            .active,.disabled{border: 1px solid #000;margin: 0 2px;padding: 5px 10px}
        </style>

        <div class="pagelist">
            {{ $article->links() }}
        </div>




    </div>
    <!--blogsbox end-->
    @include('home/public/index_left')

</div>


@include('home/public/fotter')
