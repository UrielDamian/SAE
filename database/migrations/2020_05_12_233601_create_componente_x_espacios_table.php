<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponenteXEspaciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('componente_x_espacios', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('cantidad');
			$table->decimal('Total', 8, 2);

			$table->integer('evento')->unsigned();
			$table->foreign('evento')->references('id')->on('eventos');

			$table->integer('componente')->unsigned();
			$table->foreign('componente')->references('id')->on('componentes');
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
        Schema::dropIfExists('componente_x_espacios');
    }
}
