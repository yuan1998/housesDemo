<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAdminMessageAddForeignKeyMessageIdOnMessageTextContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_messages', function (Blueprint $table) {
            $table->foreign('message_id')->references('id')->on('messageText');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_messages', function (Blueprint $table) {
            $table->dropForeign(['message_id']);
        });
    }
}
