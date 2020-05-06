<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Recursos extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opPadre')->unsigned();
            $table->string('TituloOpcion',30);
            $table->string('url',120);
            $table->string('icono',60);
			$table->foreign('opPadre')->references('id')->on('opcionesm');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recursos');
    }
}
