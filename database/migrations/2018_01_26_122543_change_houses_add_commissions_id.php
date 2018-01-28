<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHousesAddCommissionsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('building');
            $table->dropColumn('unit');
            $table->dropColumn('house_number');
            $table->dropColumn('community');
            $table->dropColumn('expect_price');
            $table->dropColumn('contact');
            $table->dropColumn('tel');
            $table->dropColumn('status');
            $table->dropColumn('user_id');
            $table->unsignedInteger('commissioned_id')->comment('委托Id');
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
            $table->dropColumn('commissioned_id');
            $table->string('contact')->nullable()->comment('联系人');
            $table->string('tel')->nullable()->comment('联系人电话');
            $table->string('unit')->nullable()->comment('单元号');
            $table->string('house_number')->nullable()->comment('门牌号');
            $table->string('building')->nullable()->comment('楼栋号');
            $table->string('community')->default('无')->comment('小区名称');
            $table->float('expect_price')->comment('期望价格');
            $table->unsignedInteger('user_id')->comment('用户id(外键)');
            $table->string('status')->default('audit')->comment('状态');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
