<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Entities\Estado::class, function (Faker $faker) {
    return [
        'nome' => $faker->city
    ];
});

$factory->define(App\Entities\Cidade::class, function (Faker $faker) {
    return [
        'nome' => $faker->city,
        'estado_id' => 1,
        'populacao' => str_random(10),
        'numero_eleitores' => str_random(10),
        'gentilico' => $faker->word,
        'idh' => str_random(10),
        'pib' => str_random(10),
        'area_km2' => str_random(10),
        'codigo_ibge' => str_random(5),
        'codigo_tse' => str_random(5),
    ];
});

$factory->define(App\Entities\Cargo::class, function (Faker $faker) {
    return [
        'nome' => $faker->jobTitle
    ];
});

$factory->define(App\Entities\Politico::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'endereco' => $faker->streetAddress,
        'email' => $faker->email,
        'data_nascimento' => $faker->date('Y-m-d', 'now'),
        'cep' => rand(100000, 99999999),
        'telefone' => $faker->phoneNumber,
        'foto' => $faker->city,
        'cpf' => rand(100000, 99999999),
    ];
});

$factory->define(App\Entities\Tipo::class, function (Faker $faker) {
    return [
        'nome' => $faker->jobTitle
    ];
});

$factory->define(App\Entities\PresidenteCoordenador::class, function (Faker $faker) {
    return [
        'cidade_id' => rand(1,5),
        'tipo_id' => rand(1,3),
        'nome' => $faker->name,
        'endereco' => $faker->streetAddress,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->email,
        'foto' => $faker->city,
    ];
});

$factory->define(App\Entities\Apoiador::class, function (Faker $faker) {
    return [
        'cidade_id' => rand(1,5),
        'nome' => $faker->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->email,
        'endereco' => $faker->streetAddress,
        'foto' => $faker->city,
    ];
});

$factory->define(App\Entities\Orgao::class, function (Faker $faker) {
    return [
        'nome' => $faker->sentence
    ];
});

$factory->define(App\Entities\Recurso::class, function (Faker $faker) {
    return [
        'orgao_id' => rand(1,3),
        'cidade_id' => rand(1,5),
        'ano' => $faker->year('now'),
        'instituicao' => $faker->company,
        'valor' => $faker->randomFloat(2, 10, 100),
        'acao' => $faker->sentence,
        'situacao' => $faker->word,
        'processo' => rand(10000, 99999),
    ];
});

$factory->define(App\Entities\Eleicao::class, function (Faker $faker) {
    return [
        'ano_eleicao' => 2010,
        'tipo_eleicao' => $faker->randomElement(['D','V']),
        'cidade_id' => rand(1,5),
    ];
});

$factory->define(App\Entities\PoliticoEleicao::class, function (Faker $faker) {
    return [
        'politico_id' => rand(1,20),
        'eleicao_id' => rand(1,5),
        'cargo_id' => rand(1,5),
        'eleito' => $faker->randomElement(['S' ,'N']),
        'partido' => $faker->randomElement(['PTB' ,'PMDB', 'PSDB', 'PP', 'PDT']),
        'coligacao' => $faker->sentence,
        'quantidade_votos' => rand(100, 500000),
    ];
});

$factory->define(App\Entities\CidadePolitico::class, function (Faker $faker) {
    return [
        'cidade_id' => rand(1,5),
        'prefeito_id' => rand(1,20),
        'vice_prefeito_id' => rand(1,20),
        'candidato_ptb_id' => rand(1,20),
    ];
});

$factory->define(App\Entities\Role::class, function (Faker $faker) {
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Entities\UserRole::class, function (Faker $faker) {
    return [
        'user_id' => rand(2,21),
        'role_id' => rand(1,3),
    ];
});