<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(User::pluck('id')),
        'memo' => $faker->realText(50),
        'total' => $faker->numberBetween(50000, 1000000),
        'status' => array_rand(Order::$status),
        'created_at' => Carbon::now()->subDay(rand(0, 65))
    ];
});
