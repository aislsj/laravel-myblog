<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class TimeController extends Controller{


    //时间墙
    public function index(){
        $article = \DB::table('article')
            ->leftjoin('article_img','article.id','=','article_img.article_id')
            ->orderby('id','desc')
            ->paginate(30);

        return view("home.time.index")->with('article',$article);
    }
}
