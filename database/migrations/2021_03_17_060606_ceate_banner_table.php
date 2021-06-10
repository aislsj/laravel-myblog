<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('banner_title')->nullable()->comment('标题');
            $table->integer('banner_sort')->comment('排序');
            $table->string('banner_img')->comment('首页轮播图');
            $table->string('articlelink')->nullable()->comment('文章链接');
            $table->string('interlink')->nullable()->comment('友情链接');

        });
        DB::statement("ALTER TABLE `banner` comment'轮播图'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banner');

    }
}
