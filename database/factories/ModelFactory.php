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

$factory->define(App\Notifications::class, function(Faker\Generator $faker) use($factory) {
    $id = $faker->numberBetween(1, 4);
    return [
        'id' => $id,
        'user_id' => $id,
        'verhuring' => 0
    ];
});

$factory->define(App\Permission::class, function(Faker\Generator $faker) use($factory) {
    return [

        'user_id' => factory(App\User::class)->create()->id,
        'verhuurbeheer' => 1
    ];
});