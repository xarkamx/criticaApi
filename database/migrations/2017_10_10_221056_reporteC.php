<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReporteC extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporteCiudadano', function (Blueprint $table) {
            $table->increments('id');
            $table->text('coordenadas');
            $table->text('correo');
            $table->text('descripcion');
            $table->text('imagen');
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
        Schema::drop('reporteCiudadano');
    }
}
