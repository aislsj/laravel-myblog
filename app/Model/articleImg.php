<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class articleImg extends Model
{
    protected $table = 'article_img';

    public function article()
    {
        return $this->belongsTo('App\Model\article', 'article_id', 'id');
    }
}
