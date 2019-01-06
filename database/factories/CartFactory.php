<?php

use App\Model\Guest;
use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(App\Model\Cart::class, function (Faker $faker) {
    return [
        'guest_id' => function() {
        	return Guest::all()->random();
        },
        'product_id' => function() {
        	return Product::all()->random();
        },
    	'quantity' => $faker->randomDigit,
    ];
});
