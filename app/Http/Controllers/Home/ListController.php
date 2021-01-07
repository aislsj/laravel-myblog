<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2018/2/5
 * Time: 19:13
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\model\article;

class ListController extends Controller{

    //后台首页
    public function index($id =  0){


        $list = article::on('mysql');
        $list = $list->with('content');
        $list = $list->with('img');
        $list = $list->orderBy('id');
        $list = $list->where('life_id',0);
//        if($id == 0){
//            $list = $list->where('type_id','=',$id);
//        }
        $count  = $list->get()->count();

        $list   = $list->paginate(10);

//        dd($list);exit;
//

//        foreach($article as $k => $data){
//            $reply_cont =   \DB::table('article_reply')->where('article_id','=',$data->id)->count();
//            $article[$k]->article_reply = $reply_cont;
//        }

        return view("home.list.index")->with('article',$list);
    }



    //博文页面展示
    public function info($id){
        $article = \DB::table('article')
            ->leftjoin('article_content','article.id','=','article_content.article_id')
            ->where('article.id','=',$id)
            ->first();

        return view("home.list.info")->with('article',$article);

    }












//
//    public static function getAdminList(array $data)
//    {
//        $list = Admin::on('mysql')
//            ->with('roles')
//            ->orderBy('id');
//        $list = searchForKeys($data, $list);
//
//        $user = auth()->user();
//        $role = $user->getRoleNames()->toArray();
//        if (strpos(implode($role), 'admin') === false) {
//            $roles   = $user->roles->toArray();
//            $userIds = Admin::role(reset($roles)['id'])->pluck('id')->toArray();
//            $list    = $list->whereIn('id', $userIds);
//        }
//
//        $count  = $list->get()->count();
//        $list   = $list->select(['id', 'name', 'account', 'num', 'status', 'email', 'created_at', 'updated_at']);
//        $list   = $list->paginate($data['limit']);
//        $list   = $list->map(function ($item) {
//            $item->status    = $item->status == 1 ? '正常' : '禁用';
//            $roles           = $item->roles->toArray();
//            $item->role_name = reset($roles)['display_name'];
//            unset($item->roles);
//            return $item;
//        });
//        $list   = $list->toArray();
//        $result = [
//            'count' => $count,
//            'data'  => $list,
//        ];
//
//        return $result;
//    }




}