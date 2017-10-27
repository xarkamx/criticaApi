<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Media extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Media', function (Blueprint $table) {
            $table->increments('id');
            $table->text('path');
            $table->text('title');
            $table->text('type');
            $table->text('placeID');
            $table->text('postID');
            $table->text('thumb');
            $table->text('wpID');
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
        Schema::drop('Media');
    }
}
