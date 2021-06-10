<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CategoryService;

class CategoryController extends Controller{



    public function index($id =  0){

        $Article = ArticleService::getArticleList('category',$id,10);
        $Category = CategoryService::getCategory($id);

        return view("home.category.index")->with('article',$Article)->with('category',$Category['data']);
    }



    //博文页面展示
    public function info($id){

        $ArticleInfo = ArticleService::getArticle($id);
        $Category = CategoryService::getCategory($ArticleInfo['data']['category_id']);



        return view("home.category.info")->with('article',$ArticleInfo['data'])->with('category',$Category['data']);
    }


}
