<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller{
    //后台首页
    public function index(){
        $config = \DB::table('config')->get();
        return view("admin.sys.config.index")->with('config',$config);
    }


    public function  update_config(Request $request){

//      DB::table('users')->where('description', 1)->update(array('votes' => 1));
        $config = $request->all();
        unset($config['_token']);
        foreach($config as $k=>$v){
            \DB::table('config')->where('enname','=', $k)->update(array('values'=> $v));
        }
       return  redirect()->action('Admin\SettingController@index');
    }

}