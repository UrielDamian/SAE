<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsRecs extends Migration
{

/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('us_recs', function (Blueprint $table) {
            $table->increments('id');

			$table->integer('idUs')->unsigned();
            $table->foreign('idUs')->references('id')->on('users');

			$table->integer('idrec')->unsigned();
            $table->foreign('idrec')->references('id')->on('recursos');

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
        Schema::dropIfExists('us_recs');
    }
}
