<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $table = 'article';



    public function articleContent(){
        return $this->hasOne('App\Models\ArticleContent', 'article_id', 'id');
    }


    public function articleImg(){
        return $this->hasMany('App\Models\ArticleImg', 'article_id', 'id');
    }

    public function articleCategory(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

}
