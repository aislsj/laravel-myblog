<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class AboutController extends Controller{


    //关于我
    public function index(){
        return view("home.about.index");
    }
}
