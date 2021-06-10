<?php

namespace App\Http\ViewComposers;


use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\ConfigService;
use App\Services\LableService;
use Illuminate\View\View;

class HomePublicComposer
{

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }


    public function compose(View $view){
        $Category  = $this->CategoryService->CategoryList();
        $Category  = $this->CategoryService->generateTree($Category['data']);

        //獲取推薦文章
        $RmendArticle = ArticleService::getArticleList('recommend',0,10);

        //獲取點擊排行文章
        $click_article = ArticleService::getArticleList('clack',0,10);

        //標籤  網頁標籤與友情標籤
        $lable  = LableService::getLableList(1);
        $amity_link  = LableService::getLableList(2);

        //系統内容
        $configs = ConfigService::getConfig();
        $myconfig = [];
        foreach ($configs as $config){
            if($config['enname'] == 'Blogger_img'){
                $myconfig['blogger_img']=$config['values'];
            }
            if($config['enname'] == 'description'){
                $myconfig['description']=$config['values'];
            }
            if($config['enname'] == 'keywords'){
                $myconfig['keywords']=$config['values'];
            }
        }


        $view->with('list',$Category)->with('lable',$lable['data'])->with('amity_link',$amity_link['data'])->with('click_article',$click_article)->with('re_article',$RmendArticle)->with('myconfig',$myconfig);;
    }
}
