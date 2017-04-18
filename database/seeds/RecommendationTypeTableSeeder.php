<?php

use App\Recommendation;
use App\Type;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RecommendationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $recommendationId = Recommendation::lists('id');
        $typeId = Type::lists('id');

        foreach(range(1, 30) as $index){
            DB::table('recommendation_type')->insert([
                'recommendation_id' => $faker->randomElement($recommendationId),
                'type_id' => $faker->randomElement($typeId),
            ]);
        }
    }
}
