<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gasolineras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasolineras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gasID');
            $table->text('nombre');
            $table->text('domicilio');
            $table->float('latitud');
            $table->float('longitud');
            $table->float('regular');
            $table->float('premium');
            $table->float('diesel');
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
        Schema::drop('gasolineras');
    }
}
