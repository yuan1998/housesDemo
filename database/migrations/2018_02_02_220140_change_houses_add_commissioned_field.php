<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHousesAddCommissionedField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('委托人用户ID');

            $table->string('unit_number')->comment('单元号');
            $table->string('building_number')->comment('楼栋号');
            $table->string('house_number')->comment('房间号');
            $table->string('contact')->comment('联系人');
            $table->string('tel')->comment('联系人电话');
            $table->string('expect_price')->comment('期望价格');
            $table->string('community')->comment('小区');
            $table->string('status')->default('audit')->comment('状态');
            $table->text('location')->nullable()->comment('location');

            $table->string('city')->nullable()->comment('city');
            $table->foreign('user_id')->references('id')->on('users');

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
            $table->dropForeign(['user_id']);
            $table->dropColumn('unit_number');
            $table->dropColumn('building_number');
            $table->dropColumn('house_number');
            $table->dropColumn('contact');
            $table->dropColumn('tel');
            $table->dropColumn('expect_price');
            $table->dropColumn('community');
            $table->dropColumn('status');
            $table->dropColumn('city');
            $table->dropColumn('location');
        });
    }
}
