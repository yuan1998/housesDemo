<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHousesDeedInfoType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropColumn('deed_info');
        });
        Schema::table('houses', function (Blueprint $table) {
            $table->json('deed_info')->nullable()->comment('房产资料');
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
            $table->dropColumn('deed_info');
        });
        Schema::table('houses', function (Blueprint $table) {
            $table->string('deed_info')->nullable()->comment('房产资料');
        });
    }
}
