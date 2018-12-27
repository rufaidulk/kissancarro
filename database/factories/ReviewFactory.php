<?php

use App\User;
use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(App\Model\Review::class, function (Faker $faker) {
    return [
        'product_id' => function() {
        	/*==========================================
	    	|	
	    	| retrieves all products table data in a randoem order
	    	*/
        	return Product::all()->random();
        },
        'user_id' => function() {
            return User::all()->random();
        },
       // 'customer' => $faker->name,
        'review' => $faker->paragraph,
        'star' => $faker->numberBetween(0, 5),
    ];
});
