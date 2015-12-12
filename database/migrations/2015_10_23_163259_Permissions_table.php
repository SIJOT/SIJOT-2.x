<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_permissions', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('user_id')->unique();
            $t->integer('cloud');
            $t->integer('verhuurbeheer');
            $t->integer('ledenbeheer');
            $t->integer('media');
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
        Schema::dropIfExists('cms_permissions');
    }
}
