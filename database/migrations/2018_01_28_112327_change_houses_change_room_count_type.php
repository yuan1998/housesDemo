<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHousesChangeRoomCountType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropColumn('room_count');

        });

        Schema::table('houses', function (Blueprint $table) {

            $table->json('room_count')->nullable()->comment('户型');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
             $table->dropColumn('room_count');
        });
        Schema::table('houses', function (Blueprint $table) {
            $table->string('room_count')->nullable()->comment('户型');
        });
    }
}
