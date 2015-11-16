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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => $faker->numberBetween(0, 1),
        'blocked' => $faker->numberBetween(0, 1),
    ];
});

$factory->define(App\Verhuring::class, function(Faker\Generator $faker) {
    return [
        'Start_Datum' => $faker->date('Y-m-d'),
        'Eind_Datum' => $faker->date('Y-m-d'),
        'Email' => $faker->email,
        'Status' => $faker->text,
        'GSM' => $faker->phoneNumber,
    ];
});

$factory->define(App\Notifications::class, function(Faker\Generator $faker) {
    $id = $faker->numberBetween(1, 4);
    return [
        'user_id' => $id,
        'verhuring' => 0,
    ];
});

$factory->define(App\Permission::class, function(Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'verhuurbeheer' => 1
    ];
});

$factory->define(App\Info::class, function(Faker\Generator $faker) {
    return [
      'user_id' => 1, 
      'verhuring' => 1
    ]; 
});
