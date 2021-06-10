<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i=1; $i <= 1000000; $i++){
            $noncestr = "lsj";

//            $charts = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz0123456789";
//            $max = strlen($charts);
//            for($i = 0; $i < 8; $i++) {
//                $noncestr .= $charts[mt_rand(0, $max)];
//            }
            $STR = intval(microtime(true) * 1000 * 1000);
            $STR2 = $STR.$noncestr;
//            $data['id'] = $i;

            $data['ceshi1'] = $STR;
            $data['ceshi2'] = $STR2;
            \DB::table('ceshi')->insert($data);
        }



    }
}
