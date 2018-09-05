<?php

use Illuminate\Database\Seeder;
use App\Entities\Eleicao;

class EleicaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eleicao')->delete();
        factory(Eleicao::class, 5)->create();
    }
}
