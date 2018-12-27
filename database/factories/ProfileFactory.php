<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Model\Profile::class, function (Faker $faker) {
    return [
        'user_id' => function() {
    		return User::all()->random();
    	},
    	'customer_name' => $faker->name,
    	'customer_contact' => $faker->e164PhoneNumber,
    	'street' => $faker->streetName,
    	'city' => $faker->city,
    	'district' => $faker->state,
    	'zipcode' => $faker->postcode,
    	'landmark' => $faker->secondaryAddress,
    	'address_type' => $faker->randomElement(['work', 'home']),
    ];
});
