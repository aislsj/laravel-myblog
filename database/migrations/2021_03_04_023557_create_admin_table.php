<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('密码');
            $table->integer('status')->default(1)->comment('状态');
            $table->integer('group')->default(1)->comment('身份');
            $table->string('img')->nullable()->comment('头像');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `admin` comment'管理员'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
