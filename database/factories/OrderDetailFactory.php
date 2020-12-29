<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => $faker->randomElement(Order::pluck('id')),
        'product_id' => $faker->randomElement(Product::pluck('id')),
        'quantity' => $faker->numberBetween(1, 10)
    ];
});
