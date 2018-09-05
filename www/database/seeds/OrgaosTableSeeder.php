<?php

use Illuminate\Database\Seeder;
use App\Entities\Orgao;

class OrgaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('orgao')->delete();

        factory(Orgao::class)->create(
            [
                'nome' => 'Câmera Federal'
            ]
        );
        factory(Orgao::class)->create(
            [
                'nome' => 'Metroplan'
            ]
        );
        factory(Orgao::class)->create(
            [
                'nome' => 'SOP'
            ]
        );

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
