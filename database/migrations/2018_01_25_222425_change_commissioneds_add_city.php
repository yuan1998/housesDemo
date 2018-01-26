<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCommissionedsAddCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissioneds', function (Blueprint $table) {
            $table->string('city')->nullable()->comment('城市');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissioneds', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }
}
