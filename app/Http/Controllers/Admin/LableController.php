<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LableService;
use Illuminate\Http\Request;

class LableController extends Controller
{
    public $request;
    public $lableService;

    public function __construct(Request $request,LableService $lableService)
    {
        $this->request = $request;
        $this->lableService = $lableService;
    }

    public function index(){
        $data = $this->lableService->getLableList();
        return view("admin.lable.index")->with('data',$data['data']);
    }



    public function store(){
        $data   = $this->request->all();
        $req_result = $this->lableService->createLable($data);
        if($req_result['success']){
            return redirect('/admin/lable');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }



    public function destroy($id){
        $req_result = $this->lableService->deleteLable($id);
        if ($req_result['success'] == true) {
            $result['code'] = 1000;
            $result['msg']  = '操作成功';
        } else {
            $result['code'] = 2000;
            $result['msg']  = isset($req_result['msg']) ? $req_result['msg'] : '操作失败';
        }
        return $result;
    }
}
