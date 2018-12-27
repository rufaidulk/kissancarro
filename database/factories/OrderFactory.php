<?php

use App\User;
use App\Model\Product;
use App\Model\Profile;
use Faker\Generator as Faker;

$factory->define(App\Model\Order::class, function (Faker $faker) {
    return [
        'product_id' => function() {
    		return Product::all()->random();
    	},
    	'user_id' => function() {
    		return User::all()->random();
    	},
    	'quantity' => $faker->randomDigit,
    	'profile_id' => function() {
    		return Profile::all()->random();
    	},
    	'status' => $faker->randomElement(['completed', 'ongoing'])
    ];
});
