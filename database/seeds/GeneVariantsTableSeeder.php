<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class GeneVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run(){

        $faker = Faker::create();

        $groupId = Group::lists('id');

        foreach(range(1, 30) as $index){
            DB::table('genes')->insert([
                'name' => $faker->words(3),
                'group_id' => $faker->randomElement($groupId),
            ]);
        }
    }

}
