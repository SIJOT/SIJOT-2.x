<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VerhuurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Verhuur', function (Blueprint $t) {
            $t->increments('id');
            $t->string('Start_Datum', 255);
            $t->string('Eind_datum', 255);
            $t->string('Groep', 255);
            $t->string('Email', 255);
            $t->string('GSM');
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
        Schema::drop('Verhuur');
    }
}
