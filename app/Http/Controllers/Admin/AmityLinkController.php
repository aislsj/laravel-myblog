<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//链接标签
class AmityLinkController extends Controller
{
    /**
     *显示列表
     */
    public function index(){
        $amity = \DB::table('amity_link')->get();
        return view("admin.amity.index")->with('amity',$amity);
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
            'title'=>'required',
            'link'=>'required',
        ];
        //表单提示信息
        $messages=[
            'title.required'=>'友情链接名不能为空',
            'link.required'=>'链接url不能为空',
        ];
        $this->validate($request, $rules,$messages);
        if(\DB::table('amity_link')->insert($arr)){
            return redirect('/admin/amity_link');
        }else{
            return view('/admin/amity_link',['error'=>'插入失败']);
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
        if(\DB::table("amity_link")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
}
