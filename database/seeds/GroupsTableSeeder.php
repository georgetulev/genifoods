<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        $groups = array(
            ['id' => 1, 'name' => 'vitamin D3'],
            ['id' => 2, 'name' => 'vitamin A'],
            ['id' => 3, 'name' => 'vitamin B9'],
            ['id' => 4, 'name' => 'vitamin B12'],
        );

        DB::table('groups')->insert($groups);
    }
}
