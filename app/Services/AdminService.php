<?php

namespace App\Services;



use App\Exceptions\InternalException;
use App\Models\Admin;
use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AdminService{
    //返回用户信息
    public static function getAdminList($data){
        $list = Admin::on('mysql')
            ->orderBy('id');
        $count  = $list->get()->count();
        $list   = $list->paginate($data);
        $list   = $list->toArray();
        $result = [
            'code'  => 1000,
            'msg'   => '',
            'count' => $count,
            'data'  => $list,
        ];
        return $result;
    }

    /*创建用户*/
    public static function createAdmin(array $data)
    {
        DB::beginTransaction();
        try {
            $result = [];
//            Admin::onlyTrashed()->where('telephone', $data['telephone'])->forceDelete();
            unset($data['password_confirmation'],$data['file'],$data['_token']);
            $data['password']   = bcrypt($data['password']);
//            $data['ip']         = Request::createFromGlobals()->getClientIp();
            $data['created_at'] = Carbon::now();
            $result['success']  = Admin::insert($data);
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
    public static function editAdmin(array $data){
        DB::beginTransaction();
        try {
            $result = [];
            unset($data['password_confirmation'],$data['file'],$data['_token']);
            $admin['nickname'] = $data['nickname'];
            $admin['status'] = $data['admin_status'];
            $admin['img'] = $data['img'];
            $admin['updated_at'] = Carbon::now();
            if(isset($data['password'])){
                $admin['password']   = bcrypt($data['password']);
            }
            $data['created_at'] = Carbon::now();
            $result['success']  = Admin::where('id',$data['id'])->update($admin);
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


    public static function deleteAdmin(int $id){
        DB::beginTransaction();
        try {
            $result            = [];
            $result['success'] = Admin::where('id', $id)->delete();
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



    public static function getAdmin(int $id){
        $list = Admin::on('mysql');
        $list   = $list->where('id',$id);
        $list   = $list->first();
        $list   = $list->toArray();
        $result = ['code'  => 1000, 'msg'   => '', 'data'  => $list];
        return $result;
    }



}
