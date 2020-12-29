<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => $faker->randomElement([0, 1]),
        'created_at' => Carbon::now()
    ];
});
