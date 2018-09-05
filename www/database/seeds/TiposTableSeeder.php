<?php

use Illuminate\Database\Seeder;
use App\Entities\Tipo;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('tipo')->delete();

        factory(Tipo::class)->create(
            [
                'nome' => 'Regional'
            ]
        );
        factory(Tipo::class)->create(
            [
                'nome' => 'Municipal'
            ]
        );
        factory(Tipo::class)->create(
            [
                'nome' => 'Presidente'
            ]
        );

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
