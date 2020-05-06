<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspaciosTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espacios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ide');
            $table->integer('idencargado')->unsigned();
            $table->String('nombreEspacio',80);
            $table->String('desEspacio',180);
            $table->timestamps();

            $table->foreign('idencargado')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('espacios');
    }
}
