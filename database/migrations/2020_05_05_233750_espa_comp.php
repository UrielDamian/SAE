<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EspaComp extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espa_componentes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

			$table->integer('cantidad');
			$table->double('precio', 8, 2);

            $table->integer('espacio_id')->unsigned();
            $table->foreign('espacio_id')->references('ide')->on('espacios');

            $table->integer('compont_id')->unsigned();
            $table->foreign('compont_id')->references('id')->on('componentes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('espa_componentes');
    }
}
