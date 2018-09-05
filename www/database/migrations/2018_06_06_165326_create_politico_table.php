<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliticoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politico', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->string('email')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->string('cpf')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('politico');
    }
}
