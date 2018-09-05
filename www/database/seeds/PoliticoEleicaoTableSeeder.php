<?php

use Illuminate\Database\Seeder;
use App\Entities\PoliticoEleicao;

class PoliticoEleicaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('politico_eleicao')->delete();
        factory(PoliticoEleicao::class, 500)->create();
    }
}
