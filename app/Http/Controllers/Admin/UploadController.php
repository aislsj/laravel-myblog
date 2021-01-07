<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

//图片上传控制器
class UploadController extends Controller{
    public function upload(){
        $data = $_POST;
        $image = $data['img'];
        $imageName = "25220_".date("His",time())."_".rand(1111,9999).'.png';
        if (strstr($image,",")){
            $image = explode(',',$image);
            $image = $image[1];
        }
        $path = "Style/upload_img/img/".date("Ymd",time());
        if (!is_dir($path)){ //判断目录是否存在 不存在就创建
            mkdir($path,0777,true);
        }
        $imageSrc= $path."/". $imageName; //图片名字
        $r = file_put_contents($imageSrc, base64_decode($image));//返回的是字节数
        if (!$r) {
            $tmparr1=array('data'=>null,"code"=>1,"msg"=>"图片生成失败");
            echo json_encode($tmparr1);
        }else{
            $tmparr2=array('data'=>1,"code"=>0,"msg"=>"图片生成成功",'path'=>'/'.$imageSrc);
            echo json_encode($tmparr2);
        }
    }

}