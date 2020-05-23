<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditarSolictud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_espacios', function (Blueprint $table) {

			$table->dropForeign('solicitud_espacios_espacio_foreign');
            $table->dropColumn('espacio');

			$table->integer('even')->unsigned();
			$table->foreign('even')->references('id')->on('eventos');

			//Schema::rename('solicitud_espacios', 'solicitud_eventos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_espacios', function (Blueprint $table) {
            //
        });
    }
}
