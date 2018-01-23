<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSessionYAddExpiredTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_y', function (Blueprint $table) {
            $table->datetime('expired_time')->nullable()->comment('过期时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_y', function (Blueprint $table) {
            $table->dropColumn('expired_time');
        });
    }
}
