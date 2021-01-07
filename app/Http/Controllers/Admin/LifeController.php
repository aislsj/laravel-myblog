<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LifeController extends Controller{


    //显示分类页面
    public function index(){

        $data=\DB::table('life')->get();
        return view("admin.life.index")->with('data',$data);
    }

    public function create(){
        return view("admin.life.create");
    }


    //添加分类
    public function store(Request $request){
        $arr=$request->all();
        $rules=[
            'catename'=>'required',//存在\是否重复\6-12位',
            'sort'=>'required'//存在\是否重复\6-12位
        ];
        //表单提示信息
        $messages=[
            'catename.required'=>'请输入分类名称',
            'sort.required'=>'请输入排序号'
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            unset($arr['_token']);
            if(\DB::table('life')->insert($arr)){
                    return redirect('/admin/life');
            }else{
                return back();
            }
        }else{
           return back()->withErrors($validator);
        }
    }


    public function edit($id){
        $data=\DB::table('life')->find($id);
        return view("admin.life.edit")->with('data',$data);
    }

    public function update(Request $request){
        $data = $request->except('_token','_method');
        $rules=[
            'catename'=>'required',//存在\是否重复\6-12位',
            'sort'=>'required'//存在\是否重复\6-12位
        ];
        //表单提示信息
        $messages=[
            'catename.required'=>'请输入分类名称',
            'sort.required'=>'请输入排序号'
        ];
        $validator = \Validator::make($data,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            \DB::table('life')->where('id',$data['id'])->update($data);
            return redirect('admin/life');
        }else{
            return back()->withErrors($validator);
        }
    }

    //删除数据
    public function destroy($id){

        if(\DB::table("life")->delete($id)){//删除分类名称
            return 1;
        }else{
            return 0;
        }
    }

}