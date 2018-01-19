<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEnvelopeAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->foreign('message_id')->references('id')->on('messageText');
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
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropForeign(['message_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
