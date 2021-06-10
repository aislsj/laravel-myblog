<?php

namespace App\Services;



use App\Exceptions\InternalException;
use App\Models\Config;
use Illuminate\Support\Facades\DB;

class ConfigService{
    public static function getConfig( ){
        $list = Config::on('mysql')
            ->orderBy('id');
        $list   = $list->get();
        $list   = $list->toArray();

        foreach ($list as $k=>$data){
            switch ($data['type']){
                case 3;
                    $list[$k]['value_data'] = explode(',',$data['value']);
                    break;
            }
        }
        return $list;
    }


    public static function updateConfig(array $data){
        DB::beginTransaction();
        try {
            $result = [
                'success' => true
            ];
            unset($data['file'],$data['_token']);
            foreach ($data as $k=>$value){
              Config::where('enname',$k)->update(array('values'=> $value));
            }
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
