<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->name,
        'avata_url' => $faker->imageUrl(),
        'password' => Hash::make('123456'),
        'address' => $faker->address,
        'phone' => $faker->numerify('0##########'),
        'role' => array_rand(User::$role),
        'status' => $faker->randomElement([0, 1]),
        'created_at' => Carbon::now()
    ];
});
