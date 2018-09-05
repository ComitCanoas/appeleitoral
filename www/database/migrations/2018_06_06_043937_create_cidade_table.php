<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidade', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estado');
            $table->string('nome');
            $table->integer('populacao');
            $table->integer('numero_eleitores');
            $table->string('gentilico');
            $table->double('idh');
            $table->double('pib');
            $table->integer('area_km2');
            $table->integer('codigo_ibge');
            $table->integer('codigo_tse');
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
        Schema::dropIfExists('cidade');
    }
}
