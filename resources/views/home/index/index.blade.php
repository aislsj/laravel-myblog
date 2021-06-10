
@include('home/public/header')
<article>
    <div class="picsbox">
        <div class="banner">
            <div id="banner" class="fader">
                @foreach($data['banner'] as $banner)
                    <li class="slide" ><a href="{{$banner['articlelink']}}" target="_blank"><img src="{{$banner['banner_img']}}"><span class="imginfo">{{$banner['banner_title']}}</span></a></li>
                @endforeach
                <div class="fader_controls">
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list"></ul>
                </div>
            </div>
        </div>
        <!--banner end-->
        <div class="toppic">
            @foreach($RmendArticle as $rmend)
                <li>
                    <a href="/category/info/{{$rmend['article_id']}}" >
                        <i><img src="{{$rmend['img_auth']}}"></i>
                        <h2>{{$rmend['article_id']}}</h2>
                        <span>{{$rmend['title']}}</span>
                    </a>
                </li>
            @endforeach
        </div>
    </div>
    <div class="blank"></div>
    <!--文章开始部分-->
    <div class="blogsbox">
        @foreach($articles as $article)
            <div class="blogs" data-scroll-reveal="enter bottom over 1s" >

                <h3 class="blogtitle">
                    <a href="/category/info/{{$article['id']}}">{{$article['article_name']}}</a>
                </h3>

                @if ($article['article_img_status_name'] == '普通图片')
                    @foreach($article['articleImg'] as $article_img)
                        <span class="blogpic"><a href="/" title=""><img src="{{$article_img['article_image_path']}}" alt=""></a></span>
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




                <p class="blogtext">{{$article['article_describe']}}</p>
                <div class="bloginfo">
                    <ul>
                        <li class="author"><a href="/">{{$article['article_author']}}</a></li>
                        <li class="lmname"><a href="/">{{$article['article_keywords']}}</a></li>
                        <li class="timer">{{$article['article_addtime']}}</li>
                        <li class="view"><span>{{$article['article_reply']}}</span>条评论</li>
                        <li class="like">{{$article['article_praise']}}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <!--文章结束部分-->

    @include('home/public/index_left')
</article>



@include('home/public/fotter')

