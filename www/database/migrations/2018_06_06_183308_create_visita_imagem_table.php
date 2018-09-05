<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitaImagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visita_imagem', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('visita_id')->unsigned();
            $table->foreign('visita_id')->references('id')->on('visita');
            $table->string('nomeExtensao', 255);
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
        Schema::dropIfExists('visita_imagem');
    }
}
