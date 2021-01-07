<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//轮播图
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *显示列表
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tot=\DB::table('banner')->count();

        $datas = \DB::table('banner')
            ->leftjoin('article','banner.articlelink','=','article.id')
            ->select('banner.*','article.article_name')
            ->get();


        return view("admin.banner.index")->with('data',$datas)->with('tot',$tot);
    }
    /**
     * Show the form for creating a new resource.
     *创建资源
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = \DB::table('article')->get();

        return view("admin.banner.create")->with('articles',$articles);
    }

    /**
     * Store a newly created resource in storage.
     *数据保存
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        unset($request['_token']);
        $arr = $request->except("meinv",'file');


        //表单验证规则
        $rules=[
            'banner_img'=>'required',//存在//轮播图图片
            'banner_sort'=>'required',//存在//排序
        ];
        //表单提示信息
        $messages=[
            'banner_img.required'=>'banner图片不能为空',
            'banner_sort.required'=>'请输入排序号',
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){

            if(\DB::table('banner')->insert($arr)){
                return redirect('/admin/banner');
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
        $data = \DB::table('banner')->find($id);
        $articles = \DB::table('article')->get();


        //http://www.5idev.com/p-php_substr_strstr.shtml 字符串截取





        return view("admin.banner.edit")->with("data",$data)->with('articles',$articles);
    }
    /**
     * Update the specified resource in storage.
     *edit提交到这里来修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $arr = $request->except('_token','_method','file');




        //表单验证规则
        $rules=[
            'banner_img'=>'required',//存在//轮播图图片
            'banner_sort'=>'required',//存在//排序
        ];
        //表单提示信息
        $messages=[
            'banner_img.required'=>'轮播图图片不能为空',
            'banner_sort.required'=>'请输入排序号',
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            if(\DB::table('banner')->where('id',$arr['id'])->update($arr)){
                return redirect('admin/banner');
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
        if(\DB::table("banner")->delete($id)){
            return 1;
        }else{
            return 0;
        }
    }
}
