<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;


class ArticleController extends Controller{


    //博文页面展示
    public function info($id){//create
        //查询分类
        $article = \DB::table('article')->leftjoin('article_content','article.id','=','article_content.article_id')->where('article.id','=',$id)->first();
       return view("home.article.index")->with('articles',$article);

    }


}