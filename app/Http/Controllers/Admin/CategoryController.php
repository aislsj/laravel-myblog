<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller{

    public $request;
    public $CategoryService;

    public function __construct(Request $request,CategoryService $CategoryService)
    {
        $this->request = $request;
        $this->CategoryService = $CategoryService;
    }

    public function index(){
        $data = $this->CategoryService->CategoryList();
        $data = $this->CategoryService->generateTree($data['data']);
        return view("admin.category.index")->with('data',$data);
    }

    public function create(){
        return view("admin.category.create");
    }

    public function store(){
        $data   = $this->request->all();
        $req_result = $this->CategoryService->createCategory($data);
        if($req_result['success']){
            return redirect('/admin/category');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }


    public function edit($id){
        $req_result = $this->CategoryService->getCategory($id);
        return view("admin.category.edit")->with('data',$req_result['data']);
    }

    public function update(){
        $data   = $this->request->all();
        $req_result = $this->CategoryService->updateCategory($data);
        if($req_result['success']){
            return redirect('/admin/category');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function destroy($id){
        $req_result = $this->CategoryService->deleteCategory($id);
        if ($req_result['success'] == true) {
            $result['code'] = 1000;
            $result['msg']  = '操作成功';
        } else {
            $result['code'] = 2000;
            $result['msg']  = isset($req_result['msg']) ? $req_result['msg'] : '操作失败';
        }
        return $result;
    }

    public function sort(Request $request){
        $data = $request->all();
        $data = json_decode($data['data']);
        $data = $this->CategoryService->outputs($data);
        $req_result = BaseService::UpdatBatchData('category',$data);
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
