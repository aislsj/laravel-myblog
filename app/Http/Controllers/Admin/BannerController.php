<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\BannerService;
use Illuminate\Http\Request;


//轮播图
class BannerController extends Controller{

    public $request;
    public $bannerService;

    public function __construct(Request $request,BannerService $banner)
    {
        $this->request = $request;
        $this->bannerService = $banner;
    }


    public function index(){
        $data = $this->bannerService->getBannerList();
        return view("admin.banner.index")->with('data',$data['data']);


    }

    public function create()
    {
        return view("admin.banner.create");
    }


    public function store(){
        $data   = $this->request->all();
        $req_result = $this->bannerService->createBanner($data);
        if($req_result['success']){
            return redirect('/admin/banner');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function edit($id){
        $req_result = $this->bannerService->getBanner($id);
        return view("admin.banner.edit")->with('data',$req_result['data']);
    }

    public function update()
    {
        $data   = $this->request->all();
        $req_result = $this->bannerService->updateBanner($data);
        if($req_result['success']){
            return redirect('/admin/banner');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }

    }

    public function destroy($id){
        $req_result = $this->bannerService->deleteBanner($id);
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
