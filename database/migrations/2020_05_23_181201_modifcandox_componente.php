<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifcandoxComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('componente_x_espacios', function (Blueprint $table) {
            $table->dropForeign ('componente_x_espacios_componente_foreign');
            $table->dropColumn('componente');
			$table->dropColumn('cantidad');

			$table->integer('cantidadUsar');
			$table->string('categoria');
			$table->string('nombreComponente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('componente_x_espacios', function (Blueprint $table) {
            //
        });
    }
}
