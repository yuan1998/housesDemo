<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('标题');
            $table->float('area')->nullable()->comment('面积');
            $table->string('sub_title')->nullable()->comment('子标题');
            $table->float('price')->nullable()->comment('总价');
            $table->float('unit_price')->nullable()->comment('平方价');
            $table->float('first_pay')->nullable()->comment('首付');
            $table->longText('product_info')->nullable()->comment('描述');
            $table->string('room_count')->nullable()->comment('户型');
            $table->string('direction')->nullable()->comment('朝向');
            $table->string('community')->default('无')->comment('小区名称');
            $table->string('building')->nullable()->comment('楼栋号');
            $table->string('unit')->nullable()->comment('单元号');
            $table->string('house_number')->nullable()->comment('门牌号');
            $table->string('location_id')->nullable()->comment('所在地id');
            $table->unsignedInteger('visiting_count')->default(0)->comment('看房人数');
            $table->unsignedInteger('floor')->nullable()->comment('所在楼层');
            $table->unsignedInteger('floors')->nullable()->comment('总楼层');
            $table->string('house_type')->nullable()->comment('房屋类型');
            $table->string('contact')->nullable()->comment('联系人');
            $table->string('tel')->nullable()->comment('联系人电话');
            $table->json('house_img')->nullable()->comment('房屋图片');
            $table->string('Decoration')->default('其他')->comment('房屋装修');
            $table->unsignedInteger('floor_age')->default(0)->comment('楼房年龄');
            $table->string('supply_heating')->default('无')->comment('供暖');
            $table->string('elevator')->default('无')->comment('电梯');
            $table->longText('surroundings')->nullable()->comment('周边');
            $table->longText('community_info')->nullable()->comment('小区信息');
            $table->longText('traffic')->nullable()->comment('交通信息');
            $table->string('deed_info')->default('无')->comment('房产资料');
            $table->unsignedInteger('house_age_limit')->default(0)->comment('房屋年限');
            $table->json('huxing_map_info')->nullable()->comment('户型图信息');
            $table->json('tags')->nullable()->comment('标签');
            $table->string('status')->default('audit')->comment('状态');
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
        Schema::dropIfExists('houses');
    }
}
