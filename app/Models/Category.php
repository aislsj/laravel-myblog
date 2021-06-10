<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';



    public function categoryArticle(){
        return $this->hasMany('App\Models\Article', 'article_id', 'id');
    }
}
