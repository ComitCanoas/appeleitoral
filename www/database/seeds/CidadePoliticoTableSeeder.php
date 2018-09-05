<?php

use Illuminate\Database\Seeder;
use App\Entities\CidadePolitico;

class CidadePoliticoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cidade_politico')->delete();
        factory(CidadePolitico::class, 5)->create();
    }
}
