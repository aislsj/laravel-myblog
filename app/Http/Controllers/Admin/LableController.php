<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//链接标签
class LableController extends Controller
{
    /**
     *显示列表
     */
    public function index(){
        $lable = \DB::table('lable')->get();
        return view("admin.lable.index")->with('lable',$lable);
    }
    /**
     *创建资源
     */
    public function create(){

    }
    /**
     *数据保存
     */
    public function store(Request $request){
        unset($request['_token']);
        $arr = $request->except("meinv",'file');

        //表单验证规则
        $rules=[
            'name'=>'required',
            'link'=>'required',
        ];
        //表单提示信息
        $messages=[
            'name.required'=>'标签名不能为空',
            'link.required'=>'标签链接不能为空',
        ];
        $this->validate($request, $rules,$messages);
        if(\DB::table('lable')->insert($arr)){
            return redirect('/admin/lable');
        }else{
            return view('/admin/lable',['error'=>'插入失败']);
        }
    }
    /**
     *根据id显示表单编辑
     */
    public function edit($id){
    }
    /**
     *edit提交到这里来修改
     */
    public function update(Request $request){
    }
    /**
     *对应delete
     */
    public function destroy($id){
        //删除数据
        if(\DB::table("lable")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
}
