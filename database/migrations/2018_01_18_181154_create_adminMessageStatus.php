<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMessageStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_message_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_message_id')->comment('foreign key,adminMessage ID');
            $table->string('status')->default('read')->comment('user read status');
            $table->unsignedInteger('user_id')->comment('foreign key,users ID');
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
        Schema::dropIfExists('admin_message_statuses');
    }
}
