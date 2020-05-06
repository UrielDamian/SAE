<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudEspaciosTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('solicitud_espacios', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('usuario')->unsigned();
          $table->integer('espacio')->unsigned();
          $table->date('fecha');
          $table->string('horaInicio');
          $table->string('horaFinal');
          $table->timestamps();

		   $table->foreign('usuario')->references('id')->on('users');
		   $table->foreign('espacio')->references('ide')->on('espacios');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('solicitud_espacios');
        //
    }
}
