<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'roles', 'role_user'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->delete();
        }

        $users = array(
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'User', 'email' => 'user@example.com', 'password' => bcrypt('password'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        $roles = array(
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'user'],
        );

        $role_user = array(
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 1, 'role_id' => 2],
            ['user_id' => 2, 'role_id' => 2],
        );

        DB::table('users')->insert($users);
        DB::table('roles')->insert($roles);
        DB::table('role_user')->insert($role_user);

        Model::reguard();
    }
}
