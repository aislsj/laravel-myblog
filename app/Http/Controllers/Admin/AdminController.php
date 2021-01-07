<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;
//use Validator;//验证
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller{
   /**
     * Display a listing of the resource.
     *显示列表
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tot=\DB::table('admin')->count();
        $admin = \DB::table('admin')->paginate(5);
        return view("admin.admin.index")->with('admin',$admin)->with('tot',$tot);
    }

    /**
     * Show the form for creating a new resource.
     *创建资源
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view("admin.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *数据保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except('_token','file');
        //表单验证规则
        $rules=[
            'name'=>'required|unique:admin|between:2,12',//存在\唯一性\6-12位
            'pass'=>'required|same:check_pass|between:6,12',//存在\是否重复\6-12位
            'identity'=>'required'
        ];
        //表单提示信息
        $messages=[
            'name.required'=>'请输入用户名',
            'name.unique'=>'用户名已存在',
            'pass.required'=>'请输入密码',
            'pass.same'=>'两次密码输入不一致',
            'pass.between'=>'密码长度为6-12位',
            'name.between'=>'用户名长度为2-12位',
            'identity.required'=>'身份不能为空'
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            unset($arr['check_pass']);
            $arr['add_time']=date("Y-m-d H:i:s");
            $arr['pass']= \Crypt::encrypt($arr['pass']);
            if(\DB::table('admin')->insert($arr)){
                return redirect('/admin/admin');
            }else{
                return back();
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *根据id显示表单编辑
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = \DB::table('admin')->find($id);
        $data->pass = \Crypt::decrypt($data->pass);
        return view("admin.admin.edit")->with("data",$data);
    }

    /**
     * Update the specified resource in storage.
     *edit提交到这里来修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Update(Request  $request){
        $arr=$_POST;
        //表单验证规则
        $rules=[
            'pass'=>'required|same:check_pass|between:6,12'//存在\是否重复\6-12位
        ];
        //表单提示信息
        $messages=[
            'pass.required'=>'请输入密码',
            'pass.same'=>'两次密码输入不一致',
            'pass.between'=>'密码长度为6-12位',
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            unset($arr['_token']);
            unset($arr['_method']);
            unset($arr['check_pass']);
            $arr['pass']= \Crypt::encrypt($arr['pass']);

            $re =\ DB::table('admin')->where('id', $arr['id'])->update($arr);
            if($re){
                return redirect('/admin/admin');
            }else{
                return back();
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *对应delete
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id){
        //删除数据
        if(\DB::table("admin")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
        //修改管理员状态
        public function ajaxStatus(){
        $arr=$_POST;
        unset($arr['_token']);
        if(\DB::update("update admin set admin_status = $arr[status] where id = $arr[id]")){
            return 1;
        }else{
            return 0;
        }
    }
}


