<?php

use Illuminate\Database\Seeder;
use App\Entities\PresidenteCoordenador;

class PresidenteCoordenadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('presidente_coordenador')->delete();
        factory(PresidenteCoordenador::class, 20)->create();

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
