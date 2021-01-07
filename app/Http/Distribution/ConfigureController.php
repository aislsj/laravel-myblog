<?php

namespace App\Http\Distribution;

//use App\Models\TypeModel;
use Illuminate\View\View;

//分类数据渲染到公共页面
class ConfigureController
{

    public function compose(View $view)
    {

        $list   = \DB::table('type')->orderBy('sort', 'asc')->get();
        $life   = \DB::table('life')->orderBy('sort', 'asc')->get();
        $configs = \DB::table('config')->where('enname','=','Blogger_img')->orwhere('enname','=','description')->orwhere('enname','=','keywords')->get();

        $myconfig = [];
        foreach($configs as $config){
            if($config->enname == 'Blogger_img'){
                $myconfig['blogger_img']=$config->values;
            }
            if($config->enname == 'description'){
                $myconfig['description']=$config->values;
            }
            if($config->enname == 'keywords'){
                $myconfig['keywords']=$config->values;
            }
        }
        $view->with('list',$list)->with('life',$life)->with('myconfig',$myconfig);

    }

}