<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $roleId = Role::lists('id');
        $userId = User::lists('id');

        foreach(range(1, 30) as $index){
            DB::table('role_user')->insert([
               'role_id' => $faker->randomElement($roleId),
               'user_id' => $faker->randomElement($userId),
            ]);
        }
    }
}
