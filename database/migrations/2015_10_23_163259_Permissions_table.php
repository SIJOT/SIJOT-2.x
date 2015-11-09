<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_permissions', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('user_id');
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
        Schema::drop('cms_permissions');
    }
}
