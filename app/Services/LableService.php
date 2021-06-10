<?php

namespace App\Services;

use App\Exceptions\InternalException;
use App\Models\Category;
use App\Models\Lable;
use Illuminate\Support\Facades\DB;

class LableService{
    public static function getLableList($data = null){
        $list = Lable::on('mysql')
            ->orderBy('id');
        $count  = $list->get()->count();
        if($data){
            $list   = $list->where('type',$data);
        }
        $list   = $list->get();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'count' => $count, 'data'  => $list];
        return $result;
    }

    public static function getLable(int $id){
        $list = Category::on('mysql');
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }


    public static function createLable(array $data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            unset($data['_token']);
            Lable::insert($data);
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

    public static function deleteLable(int $id){
        DB::beginTransaction();
        try {

            $result['success'] = Lable::where('id', $id)->delete();
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




}
