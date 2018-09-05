<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurso', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('orgao_id')->unsigned();
            $table->foreign('orgao_id')->references('id')->on('orgao');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidade');
            $table->integer('ano');
            $table->string('instituicao');
            $table->double('valor');
            $table->string('acao');
            $table->string('situacao');
            $table->string('processo');
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
        Schema::dropIfExists('recurso');
    }
}
