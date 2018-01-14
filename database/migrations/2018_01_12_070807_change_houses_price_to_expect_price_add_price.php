<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHousesPriceToExpectPriceAddPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->renameColumn('price','expect_price');
           
        });
        Schema::table('houses', function (Blueprint $table) {

            $table->float('price')->nullable()->comment('价格');
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
            $table->dropColumn('price');
        });
        Schema::table('houses', function (Blueprint $table) {
            $table->renameColumn('expect_price','price')->comment('价格');
        });
    }
}
