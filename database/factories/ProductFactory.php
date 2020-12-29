<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl(),
        'price' => $faker->numerify('##0000'),
        'description' => $faker->text(100),
        'category_id' => $faker->randomElement(Category::pluck('id')),
        'status' => $faker->randomElement([0, 1]),
        'created_at' => Carbon::now(),
    ];
});
