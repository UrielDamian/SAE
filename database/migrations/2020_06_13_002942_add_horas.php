<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_eventos', function (Blueprint $table) {
			$table->Time('HoraInicio', 0);
			$table->Time('HoraFinal', 0);
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
