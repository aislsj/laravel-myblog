<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ArticleController extends Controller{

    public $request;
    public $ArticleService;

    public function __construct(Request $request,ArticleService $ArticleService){
        $this->request = $request;
        $this->ArticleService = $ArticleService;
    }


    public function index(){
        $data = ArticleService::getArticleList(10);
        return view("admin.article.index")->with('data',$data);
    }


    public function create(){
        $category = CategoryService::CategoryList();
        $categoryData= CategoryService::getTree($category['data']);
        return view("admin.article.create")->with('category',$categoryData);
    }

    public function store(){
        $data   = $this->request->all();
        $req_result = $this->ArticleService->createArticle($data);
        if($req_result['success']){
            return redirect('/admin/article');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function edit($id){
        $req_result = $this->ArticleService->getArticle($id);
        $categoryData = CategoryService::CategoryList();
        $categoryData= CategoryService::getTree($categoryData['data']);
        return view("admin.article.edit")->with('article',$req_result['data'])->with('category',$categoryData);
    }


    public function Update(){
        $data   = $this->request->all();
        $req_result = $this->ArticleService->updateArticle($data);
        if($req_result['success']){
            return redirect('/admin/article');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function destroy($id){
        $req_result = $this->ArticleService->deleteArticle($id);
        if ($req_result['success'] == true) {
            $result['code'] = 1000;
            $result['msg']  = '操作成功';
        } else {
            $result['code'] = 2000;
            $result['msg']  = isset($req_result['msg']) ? $req_result['msg'] : '操作失败';
        }
        return $result;
    }

    //添加博文图片
    public function show(){
        $data   = $this->request->all();
        switch ($data['type']){
            case 1;//普通图片
                return view("admin.article_img.img")->with('id',$data['article_id'])->with('type',1);
            case 2;//多张图片
                return view("admin.article_img.more_img")->with('id',$data['article_id'])->with('type',2);
            case 3;//大图片
                return view("admin.article_img.img")->with('id',$data['article_id'])->with('type',3);
            default;//没有图片
                $req_result = $this->ArticleService->deleteArticleImg($data['article_id']);
            break;
        }
        if(isset($req_result['success']) || $req_result['success'] == 'true'){
            return redirect('/admin/article');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }

    public function ArticleImgSave(){

        $data   = $this->request->all();
        switch ($data['type']){
            case 1;//普通图片
                $img[] =$data['image'];
                $req_result =  $this->ArticleService->addArticleImg($data['article_id'],$data['type'],$img);
                break;
            case 3;//大图片
                $img[] =$data['image'];
                $req_result =  $this->ArticleService->addArticleImg($data['article_id'],$data['type'],$img);
                break;
            case 2;//多张图片
                $req_result =  $this->ArticleService->addArticleImg($data['article_id'],$data['type'],$data['tags']);
                break;
            default;
                break;
        }
        if($req_result['success']){
            return redirect('/admin/article');
        }else{
            return back()->withErrors([$req_result['msg']])->withInput();
        }
    }




}

