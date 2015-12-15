<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotUsersGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_user_groups', function(Blueprint $t) {
            $t->integer('user_id')->unsigned()->index();
            $t->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $t->integer('group_id')->unsigned()->index();
            $t->foreign('group_id')->references('id')->on('user_groups')->onDelete('cascade');
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
        Schema::dropIfExists('pivot_user_groups');
    }
}
