<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        factory(User::class)->create(
            [
                'name' => 'Alisson Vieira',
                'email' => 'alisson.echo@gmail.com',
                'password' => Hash::make(123456),
                'remember_token' => str_random(10),
            ]
        );
        factory(User::class, 20)->create();
    }
}
