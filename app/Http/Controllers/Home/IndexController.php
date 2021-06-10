<?php
namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\BannerService;
use App\Services\RmendService;
use Illuminate\Http\Request;

class IndexController extends Controller {

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index(){
        //获取文章
        $articles = ArticleService::getArticleList(10);
        //获取轮播图
        $banneer = BannerService::getBannerList();
        $data['banner'] =$banneer['data'];
        //获取推荐文章
        $RmendArticle = RmendService::getRmendList(2);


        return view("home.index.index")->with('RmendArticle',$RmendArticle)->with('data',$data)->with('articles',$articles);
    }

}
