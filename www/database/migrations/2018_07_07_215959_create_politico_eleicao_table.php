<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticoEleicaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politico_eleicao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('politico_id')->unsigned();
            $table->foreign('politico_id')->references('id')->on('politico');
            $table->integer('eleicao_id')->unsigned();
            $table->foreign('eleicao_id')->references('id')->on('eleicao');
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargo');
            $table->enum('eleito', ['S', 'N']);
            $table->string('partido');
            $table->string('coligacao', 255);
            $table->integer('quantidade_votos');
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
        Schema::dropIfExists('politico_eleicao');
    }
}
