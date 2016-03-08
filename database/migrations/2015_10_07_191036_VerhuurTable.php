<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $t->integer('Status');
            $t->string('GSM');
            $t->softDeletes();
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
        Schema::dropIfExists('Verhuur');
    }
}
