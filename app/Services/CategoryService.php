<?php

namespace App\Services;



use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryService{
    //博文类型列表
    public static function CategoryList(){
        $list = Category::on('mysql')
            ->orderBy('id');
        $count  = $list->get()->count();
        $list   = $list->get();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'count' => $count, 'data'  => $list];
        return $result;
    }

    //获取分类
    public static function getCategory(int $id){
        $list = Category::on('mysql');
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }


    //添加博文类型
    public static function createCategory(array $data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            if (empty($data['name'])) {
                throw new InvalidRequestException('博文类型不能为空');
            }

            unset($data['_token']);
            unset($data['file']);
            $data['created_at'] = Carbon::now();
            Category::insert($data);
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

    //修改博文类型
    public static function updateCategory(array $data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            if (empty($data['name'])) {
                throw new InvalidRequestException('博文类型不能为空');
            }
            if (empty($data['sort'])) {
                throw new InvalidRequestException('排序不能为空');
            }
            if (Category::where('sort', $data['sort'])->where('id','!=', $data['id'])->exists()) {
                throw new InvalidRequestException('排序已存在');
            }
            if (Category::where('name', $data['name'])->where('id','!=', $data['id'])->exists()) {
                throw new InvalidRequestException('博文类型已存在');
            }
            unset($data['_method'],$data['_token'],$data['file']);
            Category::where('id',$data['id'])->update($data);
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

    //删除博文类型
    public static function deleteCategory(int $id){
        DB::beginTransaction();
        try {
            $result            = [];
            if (Article::where('category_id', $id)->exists()) {
                throw new InvalidRequestException('分类下面存在博文先移除后删除');
            }
            if (Category::where('sub_id', $id)->exists()) {
                throw new InvalidRequestException('请先删除子分类');
            }
            $result['success'] = Category::where('id', $id)->delete();
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



    //---------------------------------------------------------------无限极分类
    public static function outputs($menu,$parent=0){
        static $list  = [];
        foreach ($menu as $key => $handle) {
            if(isset($handle->children)) {
                $data['id']=$handle->id;
                $data['sub_id']=$parent;
                $list[] =$data;
                self::outputs($handle->children,$handle->id);
            } else{
                $data['id']=$handle->id;
                $data['sub_id']=$parent;
                $list[] =$data;
            }
        }
        return $list;
    }
    public static function getTree($array, $pid =0, $level = 0){
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        static $list = [];
        foreach ($array as $key => $value){
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($value['sub_id'] == $pid){
                //父节点为根节点的节点,级别为0，也就是第一级
                $value['level'] = $level;
                //把数组放到list中
                $list[] = $value;
                //把这个节点从数组中移除,减少后续递归消耗
                unset($array[$key]);
                //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                self::getTree($array, $value['id'], $level+1);

            }
        }
        return $list;
    }
    public static  function generateTree($array){
        //第一步 构造数据
        $items = array();
        foreach($array as $value){
            $items[$value['id']] = $value;
        }
        //第二部 遍历数据 生成树状结构
        $tree = array();
        foreach($items as $key => $item){
            if(isset($items[$item['sub_id']])){
                $items[$item['sub_id']]['son'][] = &$items[$key];
            }else{
                $tree[] = &$items[$key];
            }
        }
        return $tree;
    }



}
