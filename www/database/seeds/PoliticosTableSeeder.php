<?php

use Illuminate\Database\Seeder;
use App\Entities\Politico;

class PoliticosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('politico')->delete();
        factory(Politico::class, 20)->create();

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
