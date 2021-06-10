<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
class ShareController extends Controller{



    public function index(){
        return view("home.share.index");
    }
}
