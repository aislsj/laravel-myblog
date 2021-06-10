<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AdminController extends Controller{

    public $request;
    public $AdminService;

    public function __construct(Request $request, AdminService $AdminService){
        $this->request = $request;
        $this->AdminService = $AdminService;
    }



    public function index(){
        $data = AdminService::getAdminList(5);
        return view("admin.admin.index")->with('data',$data['data']);
    }


    public function create(){
        return view("admin.admin.create");
    }


    public function store(){
        $this->validate($this->request, [
////            'nickname'  => ['required', Rule::unique('admin')->where(function ($query) {
////                $query->whereNull('deleted_at');
////            }),
////            ],
            'nickname'  => ['required', Rule::unique('admin')],
            'username'  => ['required', Rule::unique('admin')],
            'password_confirmation'=>['required',"same:password"],
            'password'  => 'required|confirmed|min:6',
            'status'    => 'required|boolean',
            'nickname.required'=>"昵称不能为空",
            'nickname.unique'=>"昵称已存在",
            'username.required'=>"用户名不能为空",
            'username.unique'=>"此用户名已存在",
            'password_confirmation.required'=>"确认密码不能为空",
            'password_confirmation.same'=>'密码与确认密码不匹配',
        ]);
        $data       = $this->request->all();
        $req_result = $this->AdminService->createAdmin($data);
        if($req_result['success']){
            return redirect('/admin/admin');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }


    public function edit($id){
        $req_result = $this->AdminService->getAdmin($id);
        return view("admin.admin.edit")->with('data',$req_result['data']);
    }


    public function Update(){

        $this->validate($this->request, [
            'password_confirmation'=>["same:password"],
            'password_confirmation.same'=>'密码与确认密码不匹配',
        ]);
        $data       = $this->request->all();
        $req_result = $this->AdminService->editAdmin($data);
        if($req_result['success']){
            return redirect('/admin/admin');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }

    }


    public function destroy($id){
        $req_result = $this->AdminService->deleteAdmin($id);
        if ($req_result['success'] == true) {
            $result['code'] = 1000;
            $result['msg']  = '操作成功';
        } else {
            $result['code'] = 2000;
            $result['msg']  = isset($req_result['msg']) ? $req_result['msg'] : '操作失败';
        }
        return $result;
    }
//    //修改管理员状态
//    public function ajaxStatus(){
//    $arr=$_POST;
//    unset($arr['_token']);
//    if(\DB::update("update admin set admin_status = $arr[status] where id = $arr[id]")){
//        return 1;
//    }else{
//        return 0;
//    }
//    }
}


