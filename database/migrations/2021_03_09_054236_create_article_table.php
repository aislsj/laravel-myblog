<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('article_name')->comment('博文标题');
            $table->string('article_describe')->nullable()->comment('描述');
            $table->string('article_keywords')->nullable()->comment('关键词');
            $table->integer('category_id')->default(0)->comment('博文分类');
            $table->integer('article_status')->default(1)->comment('状态（1:发布,2:未发布）');
            $table->integer('article_img_status')->default(0)->comment('0:没有图片,1:普通图片,2:多张图片,3:大图片');
            $table->string('article_author')->nullable()->comment('作者');
            $table->integer('mediumint')->default(0)->comment('浏览量');
            $table->integer('article_praise')->default(0)->comment('点赞数');
            $table->string('article_url')->nullable()->comment('文章来源');
            $table->integer('recommend')->nullable()->comment('推荐与分享(0:推荐,1:否)');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `article` comment'博客文章'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}
