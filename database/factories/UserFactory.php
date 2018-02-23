<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'document' => $faker->randomNumber(8),
        'birth_date' => '2018-01-01',
        'address' => $faker->lastname,
        'phone' => $faker->randomNumber(9),
        'rol_id' => $faker->randomElement([1, 2, 3]),
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'state' => $faker->randomElement([1, 0])
    ];



});
