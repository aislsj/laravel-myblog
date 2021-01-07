<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//轮播图
class RmendController extends Controller
{
    /**
     *显示列表
     */
    public function index(){

        $rmends = \DB::table('rmend')->join('article', 'article.id', '=', 'rmend.article_id')->select('rmend.*', 'article.article_name as a_name')->get();


        return view("admin.rmend.index")->with('rmends',$rmends);
    }
    /**
     *创建资源
     */
    public function create(){
        $articles = \DB::table('article')->get();
        return view("admin.rmend.create")->with('articles',$articles);
    }

    /**
     *数据保存
     */
    public function store(Request $request){
        unset($request['_token']);
        $arr = $request->except("meinv",'file');
        //表单验证规则
        $rules=[
            'img_auth'=>'required',
            'article_id'=>'required',
        ];
        //表单提示信息
        $messages=[
            'img_auth.required'=>'封面图不能为空',
            'article_id.required'=>'链接不能为空',
        ];
        $this->validate($request, $rules,$messages);
        if(\DB::table('rmend')->insert($arr)){
            return redirect('/admin/rmend');
        }else{
            return view('/admin/rmend/create',['error'=>'插入失败']);
        }
    }
    /**
     *根据id显示表单编辑
     */
    public function edit($id){
        $rmend = \DB::table('rmend')->find($id);
        $articles = \DB::table('article')->get();
        //http://www.5idev.com/p-php_substr_strstr.shtml 字符串截取
        return view("admin.rmend.edit")->with("rmend",$rmend)->with('articles',$articles);
    }
    /**
     *edit提交到这里来修改
     */
    public function update(Request $request){
        $arr = $request->except('_token','_method','file');
        //表单验证规则
        $rules=[
            'img_auth'=>'required',
            'article_id'=>'required',
        ];
        //表单提示信息
        $messages=[
            'img_auth.required'=>'封面图不能为空',
            'article_id.required'=>'链接不能为空',
        ];
        $this->validate($request, $rules,$messages);
        if(\DB::table('rmend')->where('id',$arr['id'])->update($arr)){
            return redirect('admin/rmend');
        }else{
            return back();
        }
    }
    /**
     *对应delete
     */
    public function destroy($id){
        //删除数据
        if(\DB::table("rmend")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
}
