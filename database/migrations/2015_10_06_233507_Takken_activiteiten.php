<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TakkenActiviteiten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Takken_activiteiten', function (Blueprint $t) {
            $t->increments('id');
            $t->string('URI_fragment', 255);
            $t->string('Naam', 255);
            $t->string('Datum', 255);
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
        Schema::drop('Takken_activiteiten');
    }
}
