<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cnname')->comment('配置项中文名');
            $table->string('enname')->comment('配置项英文名');
            $table->integer('type')->comment('配置类型 1:单行文本框 2:文本域 3单选按钮 4:复选按钮 5:下拉菜单');
            $table->string('value')->nullable()->comment('配置项值');
            $table->string('values')->comment('可选值');
        });
        DB::statement("ALTER TABLE `config` comment'系统配置项'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
