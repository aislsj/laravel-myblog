<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //

    protected $table = 'article';



    public function content(){
        return $this->hasOne('App\Model\articleContent', 'article_id', 'id');
    }



    public function img(){
        return $this->hasOne('App\Model\articleImg', 'article_id', 'id');
    }

}
