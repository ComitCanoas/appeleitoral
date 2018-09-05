<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UsersTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(CidadesTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(PoliticosTableSeeder::class);
        $this->call(TiposTableSeeder::class);
        $this->call(PresidenteCoordenadorTableSeeder::class);
        $this->call(ApoiadoresTableSeeder::class);
        $this->call(OrgaosTableSeeder::class);
        $this->call(RecursosTableSeeder::class);
        $this->call(EleicaoTableSeeder::class);
        $this->call(PoliticoEleicaoTableSeeder::class);
        $this->call(CidadePoliticoTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
