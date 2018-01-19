<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEnvelopeAddSendId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->unsignedInteger('send_id')->comment('寄件人ID');
        });
        Schema::table('envelopes', function (Blueprint $table) {
            $table->foreign('send_id')->references('id')->on('users');
        });
        Schema::table('envelopes', function (Blueprint $table) {
            $table->unique(['user_id','send_id']);
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
            $table->dropUnique(['user_id','send_id']);
        });
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropForeign(['send_id']);
        });
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropColumn('send_id');
        });
    }
}
