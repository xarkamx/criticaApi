<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Hidden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Hidden', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('portId');
            $table->integer('placeId');
            $table->boolean('hide');
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
        Schema::drop('Hidden');
    }
}
