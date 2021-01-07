<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class IndexController extends CommonController{


    //首页
    public function index(){

        $article = \DB::table('article')
            ->join('article_content','article.id','=','article_content.article_id')
            ->leftjoin('article_img','article.id','=','article_img.article_id')
            ->orderby('id','desc')
            ->paginate(10);


        foreach($article as $k => $data){
            $reply_cont =   \DB::table('article_reply')->where('article_id','=',$data->id)->count();
            $article[$k]->article_reply = $reply_cont;
        }

        $banner = \DB::table('banner')->get();
        $rmend  = \DB::table('rmend')->get();



        return view("home.index.index")->with('article',$article)->with('banner',$banner)->with('rmend',$rmend);
    }
}