<?php

use Illuminate\Database\Seeder;
use App\Entities\Recurso;

class RecursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('recurso')->delete();
        factory(Recurso::class, 20)->create();

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
