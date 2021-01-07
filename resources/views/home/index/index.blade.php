
@include('home/public/header')
<article>
    <!--banner begin-->
    <div class="picsbox">
        <div class="banner">
            <div id="banner" class="fader">
                @foreach($banner as $data)
                <li class="slide" ><a href="/list/info/{{$data->articlelink}}" target="_blank"><img src="{{$data->banner_img}}"><span class="imginfo">{{$data->banner_title}}</span></a></li>
                @endforeach
                <div class="fader_controls">
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list">
                    </ul>
                </div>
            </div>
        </div>
        <!--banner end-->
        <div class="toppic">
            @foreach($rmend as $value)
                <li> <a href="/list/info/{{$value->article_id}}" > <i><img src="{{$value->img_auth}}"></i>
                        <h2>{{$value->title}}</h2>
                        <span>学无止境</span> </a> </li>
            @endforeach
        </div>
    </div>
    <div class="blank"></div>
    <!--文章开始部分-->
    <div class="blogsbox">
        @foreach($article as $value)
            <div class="blogs" data-scroll-reveal="enter bottom over 1s" >

                <h3 class="blogtitle">
                    <a href="/list/info/{{$value->id}}">{{$value->article_name}}</a>
                </h3>

                @if($value->article_img_status == 1 )
                    <span class="blogpic"><a href="/" title=""><img src="{{$value->article_img_path}}" alt=""></a></span>
                @elseif($value->article_img_status == 2)
                    <span class="bplist">
                    <a href="/" title="">
                        <?php
                        $article_img = explode(',',$value->article_img_path);
                        foreach($article_img as $img){
                            echo '<li><img src='. $img .' alt=""></li>';
                        }
                        ?>
                    </a>
                </span>
                @elseif($value->article_img_status == 3)
                    <span class="bigpic"><a href="/" title=""><img src="{{$value->article_img_path}}" alt=""></a></span>
                @endif

                <p class="blogtext">{{$value->article_describe}}</p>
                <div class="bloginfo">
                    <ul>
                        <li class="author"><a href="/">{{$value->article_author}}</a></li>
                        <li class="lmname"><a href="/">{{$value->article_keywords}}</a></li>
                        <li class="timer">{{$value->article_addtime}}</li>
                        <li class="view"><span>{{$value->article_reply}}</span>条评论</li>
                        <li class="like">{{$value->article_praise}}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <!--文章结束部分-->

    @include('home/public/index_left')
</article>



@include('home/public/fotter')

