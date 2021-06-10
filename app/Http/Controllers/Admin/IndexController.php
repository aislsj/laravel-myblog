<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * 显示后台管理模板首页
     */
    public function index(){

        return view('admin.index.index');
    }

    public function homepage(){
        return view("admin.index.homepage");
    }


    //测试添加数据
    public function ceshi(){

        ProcessPodcast::dispatch(1);
    }

}
