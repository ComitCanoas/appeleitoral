<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresidenteCoordenadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presidente_coordenador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidade');
            $table->integer('tipo_id')->unsigned();
            $table->foreign('tipo_id')->references('id')->on('tipo');
            $table->string('nome');
            $table->string('endereco');
            $table->string('email');
            $table->string('telefone');
            $table->string('foto', 255);
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
        Schema::dropIfExists('presidente_coordenador');
    }
}
