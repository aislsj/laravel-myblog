<?php

namespace App\Services;



use App\Exceptions\InternalException;
use App\Models\Admin;
use App\Models\Rmend;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RmendService{
    public static function getRmendList($data){
        $list = Rmend::on('mysql')
            ->orderBy('id');
        $list   = $list->limit($data);
        $list   = $list->get();
        $list   = $list->toArray();
        return $list;
    }

    public static function createRmend(array $data)
    {
        DB::beginTransaction();
        try {
            $result = [];
            unset($data['file'],$data['_token']);
            $result['success']  = Rmend::insert($data);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            report(new InternalException($exception));
            $result['success'] = false;
            $result['msg']     = $exception->getMessage();
            return $result;
        }
    }


    public static function getRmend(int $id){
        $list = Rmend::on('mysql');
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }

    public static function updateRmend(array $data){
        DB::beginTransaction();
        try {
            $result = [];
            $id = $data['id'];
            unset($data['_token'],$data['_method'],$data['file'],$data['_token'],$data['id']);
            $result['success']  = Rmend::where('id',$id)->update($data);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollBack();
            report(new InternalException($exception));
            $result['success'] = false;
            $result['msg']     = $exception->getMessage();
            return $result;
        }
    }










}
