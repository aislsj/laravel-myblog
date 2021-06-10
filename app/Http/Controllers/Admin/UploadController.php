<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller{
    public function upload(Request $request){
        $re_data = $request->all();
        $data = [
            'code' => 100,
            'msg' => '',
            'data' => ['src'=>''],
        ];
        switch ($re_data['type']){
            case 'category';
                $path = 'Style/upload/img/category_img/' ;
                break;
            case 'article';
                $path = 'Style/upload/img/article_img/' ;
                break;
            case 'banner';
                $path = 'Style/upload/img/banner/' ;
                break;
            case 'remend';
                $path = 'Style/upload/img/remend/' ;
                break;
            case 'config';
                $path = 'Style/upload/img/config/' ;
                break;
            default;
               $path = 'Style/upload/img/upload_img/' ;
               break;
        }
        $imageName = "25220_".date("His",time())."_".rand(1111,9999).'.png';
        if (strstr($re_data['img'],",")){
            $image = explode(',',$re_data['img']);
            $image = $image[1];
        }
        if (!is_dir($path)){ //判断目录是否存在 不存在就创建
            mkdir($path,0777,true);
        }
        $imageSrc= $path. $imageName; //图片名字
        $r = file_put_contents($imageSrc, base64_decode($image));//返回的是字节数
        if ($r) {
            $data['code'] = 200;
            $data['data']['src'] = '/'.$imageSrc;
        }
        return json_encode($data);
    }

}
