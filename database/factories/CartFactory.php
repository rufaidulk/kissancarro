<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Cart::class, function (Faker $faker) {
    return [
        'visitor' => $faker->ipv4,
    	'quantity' => $faker->randomDigit,
    ];
});
