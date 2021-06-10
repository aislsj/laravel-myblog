<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\ConfigService;
use Illuminate\Http\Request;

class SettingController extends Controller{

    public $request;
    public $ConfigService;

    public function __construct(Request $request,ConfigService $ConfigService){
        $this->request = $request;
        $this->ConfigService = $ConfigService;
    }

    public function index(){

        $data = ConfigService::getConfig();

        return view("admin.config.index")->with('data',$data);
    }


    public function  update_config(){
        $data   = $this->request->all();
        $req_result = ConfigService::updateConfig($data);

        if($req_result['success']){
            return redirect('/admin/config');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }

    }

}
