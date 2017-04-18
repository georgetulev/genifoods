<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Group;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement($array = array ('admin','user')),
    ];
});

$factory->define(App\Gene::class, function (Faker\Generator $faker){

    // consider truncate()!!!
    $groupIds = Group::lists('id')->all();

   return [
       'name' => $faker->unique()->word,
       'group_id' => $faker->randomElement($groupIds),
   ];
});


$factory->define(App\Recommendation::class, function (Faker\Generator $faker){

    return [
        'description' => $faker->sentence,
        'text' => $faker->paragraph,
    ];
});
