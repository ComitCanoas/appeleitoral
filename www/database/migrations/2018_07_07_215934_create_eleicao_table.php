<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEleicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eleicao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ano_eleicao');
            $table->enum('tipo_eleicao', ['D','V']);
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidade');
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
        Schema::dropIfExists('eleicao');
    }
}
