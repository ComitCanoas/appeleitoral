<?php

use Illuminate\Database\Seeder;
use App\Entities\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('estado')->delete();

        factory(Estado::class)->create(
            [
                'nome' => 'RS'
            ]
        );
        factory(Estado::class)->create(
            [
                'nome' => 'SC'
            ]
        );
        factory(Estado::class)->create(
            [
                'nome' => 'PR'
            ]
        );

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Schema::enableForeignKeyConstraints();
    }
}
