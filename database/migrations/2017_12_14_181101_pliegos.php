<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pliegos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pliegos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('postID');
            $table->integer('placeID');
            $table->text('pliego');
            $table->text('edicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pliegos');
    }
}
