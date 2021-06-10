<?php

namespace App\Services;



use App\Exceptions\InternalException;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerService{
    public static function getBannerList(){
        $list = Banner::on('mysql')
            ->orderBy('id');
        $count  = $list->get()->count();
        $list   = $list->get();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'count' => $count, 'data'  => $list];
        return $result;
    }

    public static function getBanner(int $id){
        $list = Banner::on('mysql');
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }


    public static function createBanner(array $data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            unset($data['_token'],$data['file']);
            Banner::insert($data);
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

    public static function updateBanner(array $data){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = true;
            unset($data['_method'],$data['_token'],$data['file']);
            Banner::where('id',$data['id'])->update($data);
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

    public static function deleteBanner(int $id){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = Banner::where('id', $id)->delete();
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
