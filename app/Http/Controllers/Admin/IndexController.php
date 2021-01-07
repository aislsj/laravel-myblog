<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Common;

class IndexController extends Controller{
    //后台首页
    public function index(){
        return view("admin.index.index");
    }
    public function homepage(){
        return view("admin.index.homepage");
    }

//    public function tiaozhuan(){
//        return redirect("admin");
//    }

}