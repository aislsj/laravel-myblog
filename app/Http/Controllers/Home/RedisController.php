<?php

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;


class RedisController extends Controller{


    /**
     * 往redis的隊列中添加庫存（用於測試的數據）
     *
     */
    public function setAddRedis(){
        $store=150;
        $res=Redis::llen('goods_store');
        echo $res;
        $count=$store-$res;
        for($i=0;$i<$count;$i++){
            Redis::lpush('goods_store',1);
        }
        echo Redis::llen('goods_store');
    }

    //生成唯一订单号
    public function build_order_no(){
        return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 使用redis队列，因为pop操作是原子的，即使有很多用户同时到达，也是依次执行，推荐使用（mysql事务在高并发下性能下降很厉害，文件锁的方式也是）
     * @param $goods_id
     * @return string
     */
    public function getGood($goods_id){
        $price =10;
        $count = Redis::lpop("goods_store");
        if(!$count){
            return "error:no store redis";
        }
        $order_sn=$this->build_order_no();

        DB::insert('insert into ih_order (order_sn,user_id,goods_id,price) values (?, ?,?,?)', [$order_sn, rand(1,15),$goods_id,$price]);

        $res = DB::update('update in_store set store_number = store_number-1 where goods_id = ?', [$goods_id]);
        if($res){
            return  "库存减少成功";
        } else{
            return "库存减少失敗";
        }
    }

    public function doLog($log){
        file_put_contents("test.txt",$log.'\r\n',FILE_APPEND);
    }

    /**
     *
     * desc 在事务中对数据进行加锁,当事务进行提交(commit)或者回滚(rollBack)时都会取消锁。
     * 单纯的开启一个事务,并不会对事务中的数据进行加锁,只会保证数据的完整性.其他数据是否可以访问，不能保证数据库的数据单一操作
     * @param $goods_id
     * @return bool
     */
    public function getGoodByMysql($goods_id)
    {
        // 开启事务
        DB::beginTransaction();
        try {
            // 需要处理的逻辑 doSomething;
            $res = DB::table("in_store")->where(['goods_id' => $goods_id])->sharedLock()->first();
            //对事务中数据进行加锁(悲观锁)
            if ($res->store_number) {
                $store_number = $res->store_number - 1;
                $num = DB::table('in_store')->where('goods_id', $goods_id)->decrement('store_number');
                if ($num) {
                    // 提交事务
                    DB::commit();
                    $msg = "减少库存成功";
                } else {
                    $msg = "减少库存失败";
                }
            } else {
                $msg = "库存不够";
            }
            DB::rollBack();
            return $msg;
        } catch (Exception $e) {
            // 数据回滚, 当try中的语句抛出异常。
            DB::rollBack();
            return false;
            // 执行一些提醒操作等等...
        }
    }
































    public $customer_number = 50;   // 允许进入队列的人数


    //开启秒杀活动
    public function index(){
        var_dump(123);

        //set存数据 创建一个 key 并设置value
        Redis::set('username_15','伊芙');

        //get命令用于获取指定 key 的值,key不存在,返回null,如果key储存的值不是字符串类型，返回一个错误。
        var_dump(Redis::get('username_15'));



        $goods_number = 10; // 商品库存数量为10
//        if (! empty(Redis::llen('goods_name'))) {
//            echo '已经设置了库存了';
//            exit;
//        }

        // 初始化
        Redis::command('del',['user_number','success']);
        // 将商品存入redis链表中
        for ($i = 1; $i <= $goods_number; $i++) {
            // lpush从链表头部添加元素
            Redis::lpush('goods_name', $i);
        }
        // 设置过期时间
        $this->setTime();
        // 返回链表 goods_name 的长度
        echo '商品存入队列成功，数量：'.Redis::llen('goods_name');
    }

    public function setTime(){
        // 设置 goods_name 过期时间，相当于活动时间
        Redis::expire('goods_name', 120);
    }

    /**
     * 这个方法，相当于点击 抢购 操作
     */
    public function start()
    {
        $uid = mt_rand(1, 99); // 假设用户ID
        // 如果人数超过50，直接提示被抢完
        if (Redis::llen('user_number') > $this->customer_number) {
            echo '遗憾，被抢完了';
            exit;
        }
        // 获取抢购结果,假设里面存了uid
        $result = Redis::lrange('success', 0, 20);
        // 如果有一个用户只能抢一次，可以加上下面判断
        if (in_array($uid, $result)) {
            echo '你已经抢过了';
            exit;
        }
        // 将用户加入队列中
        Redis::lpush('user_number', $uid);
        // 从链表的头部删除一个元素，返回删除的元素,因为pop操作是原子性，即使很多用户同时到达，也是依次执行
        $count = Redis::lpop('goods_name');
        if (! $count) {
            echo '被抢完了';
            exit;
        }
        $msg = '抢到的人为：'.$uid.'，商品ID为：'.$count;
        Redis::lpush('success', $msg);
        echo '公司拟，抢到了';
    }


    /**
     * 查看抢到结果
     */
    public function result()
    {
        $result = Redis::lrange('success', 0, 20);
        dd($result);
    }
//


}
