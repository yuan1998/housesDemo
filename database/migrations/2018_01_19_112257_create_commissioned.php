<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissioned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissioneds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unit_number')->comment('单元号');
            $table->stirng('building_number')->comment('楼栋号');
            $table->string('house_number')->comment('房间号');
            $table->string('contact')->comment('联系人');
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
        Schema::dropIfExists('commissioneds');
    }
}
