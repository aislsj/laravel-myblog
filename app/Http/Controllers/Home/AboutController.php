<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class AboutController extends Controller{


    //后台首页
    public function index(){
        return view("home.about.index");
    }
}