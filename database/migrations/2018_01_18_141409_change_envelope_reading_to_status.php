<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEnvelopeReadingToStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envelopes', function (Blueprint $table) {
            $table->dropColumn('reading');
            $table->string('status')->default('unread')->comment('阅读状态');
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
            $table->dropColumn('status');
            $table->boolean('reading')->default(0)->comment('阅读状态');
        });
    }
}
