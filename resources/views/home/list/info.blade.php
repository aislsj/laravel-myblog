
@include('home/public/header')

<article>
    <h1 class="t_nav"><span>您现在的位置是：首页 > 学无止境 > 程序人生</span><a href="/" class="n1">网站首页</a><a href="/" class="n2">学无止境</a></h1>
    <div class="infosbox">
        <div class="newsview">
            <h3 class="news_title">{{$article->article_name}}</h3>
            <div class="bloginfo">
                <ul>
                    <li class="author"><a href="/">{{$article->article_author}}</a></li>
                    <li class="lmname"><a href="/">{{$article->article_keywords}}</a></li>
                    <li class="timer">{{$article->article_addtime}}</li>

                </ul>
            </div>
            <div class="tags"><a href="/" target="_blank">个人博客</a> &nbsp; <a href="/" target="_blank">小世界</a></div>
            <div class="news_about"><strong>简介</strong>{{$article->article_describe}}</div>
            <div class="news_con">
                <?php echo htmlspecialchars_decode($article->content)?>
            </div>
        </div>
        <div class="share">
            <p class="diggit"><a href="JavaScript:makeRequest('/e/public/digg/?classid=3&amp;id=19&amp;dotop=1&amp;doajax=1&amp;ajaxarea=diggnum','EchoReturnedText','GET','');"> 很赞哦！ </a>(<b id="diggnum"><script type="text/javascript" src="/e/public/ViewClick/?classid=2&id=20&down=5"></script>13</b>)</p>
            <p class="dasbox"><a href="javascript:void(0)" onClick="dashangToggle()" class="dashang" title="打赏，支持一下">打赏本站</a></p>
            <div class="hide_box"></div>
            <div class="shang_box"> <a class="shang_close" href="javascript:void(0)" onclick="dashangToggle()" title="关闭">关闭</a>
                <div class="shang_tit">
                    <p>感谢您的支持，我会继续努力的!</p>
                </div>
                <div class="shang_payimg"> <img src=" /Style/home/images/alipayimg.jpg" alt="扫码支持" title="扫一扫"> </div>
                <div class="pay_explain">扫码打赏，你说多少就多少</div>
                <div class="shang_payselect">
                    <div class="pay_item checked" data-id="alipay"> <span class="radiobox"></span> <span class="pay_logo"><img src=" /Style/home/images/alipay.jpg" alt="支付宝"></span> </div>
                    <div class="pay_item" data-id="weipay"> <span class="radiobox"></span> <span class="pay_logo"><img src=" /Style/home/images/wechat.jpg" alt="微信"></span> </div>
                </div>
                <script type="text/javascript">
                    $(function(){
                        $(".pay_item").click(function(){
                            $(this).addClass('checked').siblings('.pay_item').removeClass('checked');
                            var dataid=$(this).attr('data-id');
                            $(".shang_payimg img").attr("src"," /Style/home/images/"+dataid+"img.jpg");
                            $("#shang_pay_txt").text(dataid=="alipay"?"支付宝":"微信");
                        });
                    });
                    function dashangToggle(){
                        $(".hide_box").fadeToggle();
                        $(".shang_box").fadeToggle();
                    }
                </script>
            </div>
        </div>
        <div class="nextinfo">
            <p>上一篇：<a href="/news/life/2018-03-13/804.html">作为一个设计师,如果遭到质疑你是否能恪守自己的原则?</a></p>
            <p>下一篇：<a href="/news/life/">返回列表</a></p>
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

