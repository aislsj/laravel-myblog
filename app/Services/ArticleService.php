<?php

namespace App\Services;


use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Models\Article;
use App\Models\ArticleContent;
use App\Models\ArticleImg;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleService{


    public static function getArticleList($data =null,$offset = 0,$limit = 10){
        $list = Article::with(['articleContent'=>function($query){
            $query->select(['article_id','content']);
        },'articleImg'                         =>function($query){
            $query->select(['article_id','article_image_path']);
        },'articleCategory'                    =>function($query){
            $query->select(['id','name']);
        }]);
        if($data == 'clack'){
            $list   = $list->orderBy('mediumint','DESC');
        }else{
            $list   = $list->orderBy('id','DESC');
        }
        if($data == 'category'){
            $list   = $list->where('category_id',$offset);
            $offset = 0;
        }
        $list   = $list->offset($offset);
        $list   = $list->paginate($limit);
        foreach ($list as $data){
            $data->article_status = ($data->article_status==1) ? '发布' : '未发布';
            $data->recommend      = ($data->recommend) ? '未推荐' : '推荐' ;
            switch ($data->article_img_status){
                case 1;
                    $data->article_img_status_name = '普通图片';
                break;
                case 2;
                    $data->article_img_status_name = '多张图片';
                break;
                case 3;
                    $data->article_img_status_name = '大图片';
                break;
                default;
                    $data->article_img_status_name = '没有图片';
                break;
            }
        }
        return $list;
    }


    public static function getArticle($id){
        $list = Article::with(['articleContent'=>function($query){
            $query->select(['article_id','content']);
        },'articleImg'                         =>function($query){
            $query->select(['article_id','article_image_path']);
        },'articleCategory'                    =>function($query){
            $query->select(['id','name']);
        }]);
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }

    public static function createArticle($data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            if (empty($data['article_name'])) {
                throw new InvalidRequestException('博文标题不能为空');
            }
            if (empty($data['article_describe'])) {
                throw new InvalidRequestException('博文描述不能为空');
            }
            $articleContentData['content'] =  $data['article_content'];
            unset($data['_token'],$data['article_content']);
            $data['created_at'] = Carbon::now();
            Article::insert($data);
            $article_id = DB::getPdo()->lastInsertId();
            $articleContentData['article_id'] =  $article_id;
            ArticleContent::insert($articleContentData);
            DB::commit();
            return $result;
        }catch (\Exception $exception){
            DB::rollBack();
            report(new InternalException($exception));
            $result['success'] = false;
            $result['msg'] = $exception->getMessage();
            return $result;
        }
    }
    public static function updateArticle($data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            if (empty($data['article_name'])) {
                throw new InvalidRequestException('博文标题不能为空');
            }
            if (empty($data['article_describe'])) {
                throw new InvalidRequestException('博文描述不能为空');
            }

            $articleContentData['content'] =  $data['article_content'];
            unset($data['_token'],$data['article_content'],$data['_method'],);
            $data['updated_at'] = Carbon::now();
            Article::where('id',$data['id'])->update($data);
            ArticleContent::where('article_id',$data['id'])->update($articleContentData);
            DB::commit();
            return $result;//user->timestamps=false;
        }catch (\Exception $exception){
            DB::rollBack();
            report(new InternalException($exception));
            $result['success'] = false;
            $result['msg'] = $exception->getMessage();
            return $result;
        }
    }


    public static function deleteArticle(int $id){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = article::where('id', $id)->delete();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            report(new InternalException($exception->getMessage()));
            $result['success'] = false;
            $result['msg']     = $exception->getMessage();
            return $result;
        }
    }

    public static function addArticleImg($article_id,$type_id,$data){
        DB::beginTransaction();
        try {
            $result            = [];
            DB::table('article')->where('id', $article_id)->update(['article_img_status' =>$type_id]);
            //删除原图片
//            $ReData = ArticleImg::where('article_id', $article_id)->get()->toArray();
//            foreach ($ReData as $img){
//                Storage::delete(str_replace('storage', 'public', $img));
////                unlink('./public'.$img['article_image_path']);
//            }
            ArticleImg::where('article_id', $article_id)->delete();
            //添加数据
            $articleImg=[];
            foreach ($data as $k=>$img){
                $articleImg[$k]['article_image_path']=$img;
                $articleImg[$k]['article_id']=$article_id;
            }
            $result['success'] = ArticleImg::insert($articleImg);
            DB::commit();
            return $result;
        }catch (\Exception $exception){
            DB::rollBack();
            report(new InternalException($exception->getMessage()));
            $result['success'] = false;
            $result['msg']     = $exception->getMessage();
            return $result;
        }
    }


    public static function deleteArticleImg(int $article_id){
        DB::beginTransaction();
        try {
            $result            = [];
            DB::table('article')->where('id', $article_id)->update(['article_img_status' =>'0']);
            $result['success'] = ArticleImg::where('article_id', $article_id)->delete();
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            report(new InternalException($exception->getMessage()));
            $result['success'] = false;
            $result['msg']     = $exception->getMessage();
            return $result;
        }
    }


    public static function getReArticle(){
        $list = Article::with(['articleContent'=>function($query){
            $query->select(['article_id','content']);
        },'articleImg'                         =>function($query){
            $query->select(['article_id','article_image_path']);
        },'articleCategory'                    =>function($query){
            $query->select(['id','name']);
        }])->orderBy('id','DESC');
        $list   = $list->where('recommend',1);

        $list   = $list->offset(0);
        $list   = $list->paginate(10);

        return $list;
    }



}
