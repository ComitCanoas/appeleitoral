<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCidadePoliticoTable.
 */
class CreateCidadePoliticoTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cidade_politico', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidade');
            $table->integer('prefeito_id')->unsigned()->nullable();
            $table->foreign('prefeito_id')->references('id')->on('politico');
            $table->integer('vice_prefeito_id')->unsigned()->nullable();
            $table->foreign('vice_prefeito_id')->references('id')->on('politico');
            $table->integer('candidato_ptb_id')->unsigned()->nullable();
            $table->foreign('candidato_ptb_id')->references('id')->on('politico');
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
		Schema::drop('cidade_politico');
	}
}
