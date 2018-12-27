<?php

use App\Model\Order;
use Faker\Generator as Faker;

$factory->define(App\Model\Payment::class, function (Faker $faker) {
    return [
        'order_id' => function() {
    		return Order::all()->random();
    	},
    	'amount' => $faker->randomFloat,
    ];
});
