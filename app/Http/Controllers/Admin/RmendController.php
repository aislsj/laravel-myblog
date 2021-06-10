<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\RmendService;
use Illuminate\Http\Request;



class RmendController extends Controller
{

    public $request;
    public $RmendService;

    public function __construct(Request $request,RmendService $RmendService)
    {
        $this->request = $request;
        $this->RmendService = $RmendService;
    }

    public function index(){
        $req_result = $this->RmendService->getRmendList(5);
        return view("admin.rmend.index")->with('rmends',$req_result['data']);
    }

    public function create(){
        return view("admin.rmend.create");
    }


    public function store(){
        $data   = $this->request->all();
        $req_result = $this->RmendService->createRmend($data);
        if($req_result['success']){
            return redirect('/admin/remend');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function edit($id){
        $rmend = RmendService::getRmend($id);
        return view("admin.rmend.edit")->with("rmend",$rmend['data']);
    }

    public function update(){
        $data   = $this->request->all();
        $req_result = $this->RmendService->updateRmend($data);
        if($req_result['success']){
            return redirect('/admin/rmend');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function destroy($id){
        //删除数据
        if(\DB::table("rmend")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
}
