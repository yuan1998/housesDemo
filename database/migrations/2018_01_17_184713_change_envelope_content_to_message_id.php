<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEnvelopeContentToMessageId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->unsignedInteger('message_id')->comment('消息内容ID');
            $table->dropColumn('content');
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
            $table->dropColumn('message_id');
            $table->text('content')->comment('消息内容');
        });
    }
}
