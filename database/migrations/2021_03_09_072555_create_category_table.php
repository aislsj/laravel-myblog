<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->comment('类型名');
            $table->string('image')->nullable()->comment('类型图片');
            $table->integer('sub_id')->default(0)->comment('上级分类id;0无上级分类');
            $table->integer('sort')->comment('排序');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `category` comment'博文类型'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
