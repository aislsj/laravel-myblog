<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use GuzzleHttp\Psr7\Request;错误的容器
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller{



    public function index(){ //index
        $tot=\DB::table('article')->count();
        $articles = \DB::table('article')
            ->join('type', 'article.type_id', '=', 'type.id')
            ->leftjoin('article_img', 'article.id', '=', 'article_img.article_id')
            ->select('article.*', 'type.catename','article_img.article_img_path')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view("admin.article.index")->with('articles',$articles)->with('tot',$tot);
    }


    public function create(){//create
        //查询分类
        $types = \DB::table('type')->get();
        return view("admin.article.create")->with('types',$types);
    }



    public function store(Request $request){
        $arr=$request->all();
        //规则
        $rules=[
            'article_name'=>'required',
            'article_describe'=>"required",
            'type_id'=>'required',
            'article_author'=>'required',
            'article_status'=>'required',
            'article_addtime'=>'required',
            'article_content'=>'required',
        ];
        //表单提示信息
        $messages=[
            'article_name.required'=>'博文标题不能为空',
            'article_describe.required'=>'博文简介不能为空',
            'type_id.required'=>'所属分类不能为空',
            'article_author.required'=>'作者名称不能为空',
            'article_status.required'=>'博文状态不能为空',
            'article_addtime.required'=>'撰写时间不能为空',
            'article_content.required'=>'博文内容不能为空',
        ];
        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            $article_img=$request->input("article_img");
            $article_content=$request->input("article_content");
            $data=$request->except("_token","article_img",'article_content','file');
            if($article_img){
                $data['article_img_status'] = 1;
            }
            if($id=\DB::table('article')->insertGetId($data)) {
                if (\DB::table('article_content')->insert(array('content' => $article_content,'article_id' => $id))) {
                    if($article_img){
                      $re =   \DB::table('article_img')->insert(array('article_id' => $id,'article_img_stats' => 1,'article_img_path' => $article_img));
                        if($re){
                            return redirect('/admin/article');
                        }else{
                            return back();
                        }
                    }
                    return redirect('/admin/article');
                } else {
                    return back();
                }
            }
        }else{
            return back()->withErrors($validator);
        }
    }



    public function edit($id){
        $article_img_stats =  \DB::table('article')
            ->select('article.article_img_status')
            ->where('id', '=', $id)
            ->first();


        if($article_img_stats->article_img_status){
            $article =  \DB::table('article')
                ->leftjoin('article_content', 'article.id', '=', 'article_content.article_id')
                ->leftjoin('article_img', 'article.id', '=', 'article_img.article_id')
                ->select('article.*', 'article_content.content', 'article_img.article_img_path')
                ->where('id', '=', $id)
                ->first();
        }else{
            $article =  \DB::table('article')
                ->leftjoin('article_content', 'article.id', '=', 'article_content.article_id')
                ->select('article.*', 'article_content.content')
                ->where('id', '=', $id)
                ->first();
        }
        $types = \DB::table('type')->get();

        return view("admin.article.edit")->with('types',$types)->with('article',$article);
    }


    public function Update(Request  $request){
        $arr=$request->all();
        //规则
        $rules=[
            'article_name'=>'required',
            'article_describe'=>"required",
            'type_id'=>'required',
            'article_author'=>'required',
            'article_status'=>'required',
            'article_addtime'=>'required',
            'article_content'=>'required',
        ];
        //表单提示信息
        $messages=[
            'article_name.required'=>'博文标题不能为空',
            'article_describe.required'=>'博文简介不能为空',
            'type_id.required'=>'所属分类不能为空',
            'article_author.required'=>'作者名称不能为空',
            'article_status.required'=>'博文状态不能为空',
            'article_addtime.required'=>'撰写时间不能为空',
            'article_content.required'=>'博文内容不能为空',
        ];

        $validator = \Validator::make($arr,$rules,$messages);//数据 验证规则 提示信息
        if($validator->passes()){
            $article_img=$request->input("article_img");


            $article_content=$request->input("article_content");
            $data=$request->except("_token","article_img",'article_content','file','_method');
            if($article_img){
                $data['article_img_status'] = 1;
            }
            \DB::table('article')->where('id',$data['id'])->update($data);
           \DB::table('article_content')->where('article_id',$data['id'])->update(array('content' =>$article_content));
           if($article_img){
              $re =  \DB::table('article_img')->where('article_id',$data['id'])->count();
               if($re){
                   \DB::table('article_img')->where('article_id',$data['id'])->update(array('article_img_path' =>$article_img,'article_img_stats'=>1));
               }else{
                   \DB::table('article_img')->insert(array('article_img_path' =>$article_img,'article_id'=>$data['id'],'article_img_stats'=>1));
               }
           }
            return redirect('/admin/article');
        }else{
            return back()->withErrors($validator);
        }
    }

    public function destroy($id){
        $article_img_stats =  \DB::table('article')
            ->select('article.article_img_status')
            ->where('id', '=', $id)
            ->first();
        //删除数据
        if(\DB::table("article")->delete($id)){
            //删除博文图片
            if($article_img_stats->article_img_stats = 1){
                \DB::table("article_img")->where("article_id","=","$id")->delete();
            }
            //删除博文详细信息
            if( \DB::table("article_content")->where("article_id","=","$id")->delete()){
                return 1;
            }
            return 0;
        }else{
            return 0;
        }
    }



    public function more_img($id){
        return view("admin.article_img.more_img")->with('id',$id);
    }
    public function more_img_save(){
        if(array_key_exists('tags',$_POST)){
            \DB::table('article')->where('id',$_POST['article_id'])->update(array('article_img_status' => 2));
            $img = implode(',',$_POST['tags']);

            if(\DB::table('article_img')->where('article_id',$_POST['article_id'])->count() > 0){
                \DB::table('article_img')->where('article_id',$_POST['article_id'])->update(array('article_img_path' =>$img,'article_img_stats'=>2));
            }else{
                \DB::table('article_img')->insert(array('article_img_path' =>$img,'article_id'=>$_POST['article_id'],'article_img_stats'=>2));
            }
        }
        return redirect('/admin/article');
    }

    public function big_img($id){
        return view("admin.article_img.big_img")->with('id',$id);
    }
    public function big_img_save(){
        if(array_key_exists('article_img',$_POST)){
            \DB::table('article')->where('id',$_POST['article_id'])->update(array('article_img_status' => 3));
            $img = $_POST['article_img'];

            if(\DB::table('article_img')->where('article_id',$_POST['article_id'])->count() > 0){
                \DB::table('article_img')->where('article_id',$_POST['article_id'])->update(array('article_img_path' =>$img,'article_img_stats'=>3));
            }else{
                \DB::table('article_img')->insert(array('article_img_path' =>$img,'article_id'=>$_POST['article_id'],'article_img_stats'=>3));
            }
        }
        return redirect('/admin/article');
    }



    public function img($id){
        return view("admin.article_img.img")->with('id',$id);
    }
    public function img_save(){
        if(array_key_exists('article_img',$_POST)){
            \DB::table('article')->where('id',$_POST['article_id'])->update(array('article_img_status' => 1));
            $img = $_POST['article_img'];

            if(\DB::table('article_img')->where('article_id',$_POST['article_id'])->count() > 0){
                \DB::table('article_img')->where('article_id',$_POST['article_id'])->update(array('article_img_path' =>$img,'article_img_stats'=>1));
            }else{
                \DB::table('article_img')->insert(array('article_img_path' =>$img,'article_id'=>$_POST['article_id'],'article_img_stats'=>1));
            }
        }
        return redirect('/admin/article');
    }




    public function cancel_img($id){

        \DB::table('article')->where('id',$id)->update(array('article_img_status' => 0));

        if(\DB::table('article_img')->where('article_id',$id)->count() > 0){

            \DB::table("article_img")->where("article_id","=","$id")->delete();

        }
        return redirect('/admin/article');

    }

}

