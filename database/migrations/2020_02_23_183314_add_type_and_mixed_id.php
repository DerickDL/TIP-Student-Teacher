<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeAndMixedId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_question', function (Blueprint $table) {
            $table->string('type');
            $table->unsignedInteger('mixed_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_question', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('mixed_id');
        });
    }
}
