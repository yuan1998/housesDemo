<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEnvelope extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envelopes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->nullable()->comment('内容');
            $table->unsignedInteger('user_id')->comment('收信用户ID');
            $table->boolean('reading')->default('0')->comment('阅读状态');
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
        Schema::dropIfExists('envelopes');
    }
}
