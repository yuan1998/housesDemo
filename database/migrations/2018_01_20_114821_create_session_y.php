<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionY extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_y', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->comment('标记码');
            $table->unsignedInteger('user_id')->nullable()->comment('登录后记录用户ID');
            $table->json('data')->nullable()->comment('保存该客户端的数据');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('session_y');
    }
}
