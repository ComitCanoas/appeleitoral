<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkFotoToPresidenteCoordenadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presidente_coordenador', function (Blueprint $table) {
            $table->string('link_foto', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presidente_coordenador', function (Blueprint $table) {
            $table->dropColumn('link_foto');
        });
    }
}
