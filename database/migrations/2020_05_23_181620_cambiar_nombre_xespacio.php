<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarNombreXespacio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('componente_x_espacios', function (Blueprint $table) {
            Schema::rename('componente_x_espacios', 'componente_x_evento');
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
