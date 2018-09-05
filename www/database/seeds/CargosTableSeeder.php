<?php

use Illuminate\Database\Seeder;
use App\Entities\Cargo;

class CargosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('cargo')->delete();

        factory(Cargo::class)->create(['nome' => 'DEPUTADO FEDERAL']);
        factory(Cargo::class)->create(['nome' => 'DEPUTADO ESTADUAL']);
        factory(Cargo::class)->create(['nome' => 'PREFEITO']);
        factory(Cargo::class)->create(['nome' => 'VICE-PREFEITO']);
        factory(Cargo::class)->create(['nome' => 'VEREADOR']);

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
