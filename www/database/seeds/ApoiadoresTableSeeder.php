<?php

use Illuminate\Database\Seeder;
use App\Entities\Apoiador;

class ApoiadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('apoiador')->delete();
        factory(Apoiador::class, 20)->create();

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
