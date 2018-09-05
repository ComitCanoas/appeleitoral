<?php

use Illuminate\Database\Seeder;
use App\Entities\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->delete();

        factory(UserRole::class)->create(
            [
                'user_id' => 1,
                'role_id' => 1
            ]
        );

        //factory(UserRole::class, 20)->create();
    }
}
