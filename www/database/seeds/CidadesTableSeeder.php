<?php

use Illuminate\Database\Seeder;
use App\Entities\Cidade;

class CidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('cidade')->delete();

        factory(Cidade::class)->create(
            [
                'nome' => 'Canoas',
                'estado_id' => 1,
                'populacao' => 300000,
                'numero_eleitores' => 50000,
                'gentilico' => 'teste',
                'idh' => 123,
                'pib' => 123,
                'area_km2' => 50000,
                'codigo_ibge' => 12345,
                'codigo_tse' => 12345,
            ]
        );

        factory(Cidade::class)->create(
            [
                'nome' => 'Santa Maria',
                'estado_id' => 1,
                'populacao' => 300000,
                'numero_eleitores' => 50000,
                'gentilico' => 'teste',
                'idh' => 123,
                'pib' => 123,
                'area_km2' => 50000,
                'codigo_ibge' => 12345,
                'codigo_tse' => 12345,
            ]
        );

        factory(Cidade::class)->create(
            [
                'nome' => 'Porto Alegre',
                'estado_id' => 1,
                'populacao' => 300000,
                'numero_eleitores' => 50000,
                'gentilico' => 'teste',
                'idh' => 123,
                'pib' => 123,
                'area_km2' => 50000,
                'codigo_ibge' => 12345,
                'codigo_tse' => 12345,
            ]
        );

        factory(Cidade::class)->create(
            [
                'nome' => 'Passo Fundo',
                'estado_id' => 1,
                'populacao' => 300000,
                'numero_eleitores' => 50000,
                'gentilico' => 'teste',
                'idh' => 123,
                'pib' => 123,
                'area_km2' => 50000,
                'codigo_ibge' => 12345,
                'codigo_tse' => 12345,
            ]
        );

        factory(Cidade::class)->create(
            [
                'nome' => 'São Luiz Gonzaga',
                'estado_id' => 1,
                'populacao' => 300000,
                'numero_eleitores' => 50000,
                'gentilico' => 'teste',
                'idh' => 123,
                'pib' => 123,
                'area_km2' => 50000,
                'codigo_ibge' => 12345,
                'codigo_tse' => 12345,
            ]
        );
        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
