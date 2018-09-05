<?php

use Illuminate\Database\Seeder;
use App\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        factory(Role::class)->create(['nome' => 'Administrar']);
        factory(Role::class)->create(['nome' => 'Cadastrar']);
        factory(Role::class)->create(['nome' => 'Consultar']);
    }
}
