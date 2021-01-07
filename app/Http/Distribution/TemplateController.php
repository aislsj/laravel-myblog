<?php

namespace App\Http\Distribution;

//use App\Models\TypeModel;
use Illuminate\View\View;

//分类数据渲染到公共页面
class TemplateController
{

    public function compose(View $view)
    {

        //推荐文章
        $re_article      = \DB::table('article')
                                ->leftjoin('article_img', 'article.id', '=', 'article_img.article_id')
                                ->select('article.*','article_img.article_img_path')
                                ->where('recommend','=',1)
                                ->orderBy('id', 'desc')
                                ->paginate(5);
        //点击排行
        $click_article   = \DB::table('article')
                                ->leftjoin('article_img', 'article.id', '=', 'article_img.article_id')
                                ->select('article.*','article_img.article_img_path')
                                ->orderBy('id', 'desc')
                                ->paginate(5);
        //标签
        $lable           = \DB::table('lable')->get();
        //友情链接
        $amity_link      = \DB::table('amity_link')->get();

        $view->with('re_article',$re_article)->with('click_article',$click_article)->with('lable',$lable)->with('amity_link',$amity_link);

    }

}