<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdminMessageStatusAddForeignKeyUserIdRefUsersOnIdAndAdminMessageIdRefAdminMessageOnId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adminMessageStatus', function (Blueprint $table) {
            $table->foreign('admin_message_id')->references('id')->on('adminMessages');
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
        Schema::table('adminMessageStatus', function (Blueprint $table) {
            $table->dropForeign(['admin_message_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
