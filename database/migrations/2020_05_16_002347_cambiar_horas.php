<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_eventos', function (Blueprint $table) {
			$table->dropColumn('horaInicio');
			$table->dropColumn('horaFinal');
			//$table->dateTime('HoraInicio', 0);
		//	$table->dateTime('HoraFinal', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_eventos', function (Blueprint $table) {
            //
        });
    }
}
