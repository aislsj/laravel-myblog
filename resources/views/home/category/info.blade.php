index.blade.php
info.blade.php
@include('home/public/header')

<article>
    <h1 class="t_nav">
{{--        <span>您现在的位置是：首页 > 学无止境 > 程序人生</span>--}}
        <a href="/" class="n1">网站首页</a><a href="/category/{{$category['id']}}" class="n2">{{$category['name']}}</a>
    </h1>
    <div class="infosbox">
        <div class="newsview">
            <h3 class="news_title">{{$article['article_name']}}</h3>
            <div class="bloginfo">
                <ul>
                    <li class="author"><a href="/">{{$article['article_author']}}</a></li>
                    <li class="lmname"><a href="/">{{$article['article_keywords']}}</a></li>
                    <li class="timer">{{$article['created_at']}}</li>

                </ul>
            </div>
            <div class="tags"><a href="/" target="_blank">个人博客</a> &nbsp; <a href="/" target="_blank">小世界</a></div>
            <div class="news_about"><strong>简介</strong>{{$article['article_describe']}}</div>
            <div class="news_con">
                <?php echo htmlspecialchars_decode($article['article_content']['content'])?>
            </div>
        </div>



        <div class="news_pl">
            <h2>文章评论</h2>
            <ul>
                <div class="gbko">
                    <script>
                        function CheckPl(obj) {
                            if(obj.saytext.value=="") {
                                alert("没有什么话要说吗？");
                                obj.saytext.focus();
                                return false;
                            }
                            return true;
                        }
                    </script>


                    <form action="" method="post" name="saypl" id="saypl">
                        <div id="plpost">
                            <p class="saying">来说两句吧...</p>
                            <p class="yname"><span>昵称:</span><input name="username" type="text" class="inputText" id="username" value="" size="16" /></p>
                            <p class="yname"><span>邮箱:</span><input name="e_mail" type="text" class="inputText" id="username" value="" size="16" /></p>
                            <p class="yname"><span>网站:</span><input name="index" type="text" class="inputText" id="username" value="" size="16" /></p>
                            <input name="id" type="hidden" id="id" value="15" />
                            <textarea name="saytext" rows="6" id="saytext"></textarea><input name="imageField" type="submit" value="提交"/>
                        </div>
                    </form>

                </div>
            </ul>
        </div>
    </div>
    @include('home/public/index_left')

</article>


@include('home/public/fotter')

