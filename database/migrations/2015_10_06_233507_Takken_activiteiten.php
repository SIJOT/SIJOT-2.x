<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
        Schema::dropIfExists('Takken_activiteiten');
    }
}
