<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->comment('预约时间');
            $table->unsignedInteger('reservation_id')->comment('预约人Id');
            $table->unsignedInteger('reservation_house_id')->comment('预约房子Id');
            $table->string('status')->comment('状态');

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
        Schema::dropIfExists('houses_reservations');
    }
}
