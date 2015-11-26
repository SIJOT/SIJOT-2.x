<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TakkenInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Takken_info', function (Blueprint $t) {
            $t->increments('id');
            $t->string('URI_fragment', 255);
            $t->string('Title', 255);
            $t->string('Sub_title', 255);
            $t->string('Beschrijving', 255);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Takken_info');
    }
}
