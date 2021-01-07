<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019/1/25
 * Time: 11:19
 */
namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;

class  CommonController extends Controller{

    public  function _initialize()
    {
        $_confres = \DB::table('conofig')->select('enname','values')->get();


        foreach ($_confres as $k=>$v){
            $confres[$v['enname']]=$v['values'];
        }
        $this->with('confs',$confres);
    }
}
