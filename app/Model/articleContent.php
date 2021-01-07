<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class articleContent extends Model
{

    protected $table = 'article_content';

    public function article()
    {
        return $this->belongsTo('App\Model\article', 'article_id', 'id');
    }

}
