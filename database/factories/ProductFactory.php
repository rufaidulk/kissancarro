<?php

use App\Model\Brand;
use App\Model\Category;
use Faker\Generator as Faker;

$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'category_id' => function() {
            return Category::all()->random();
        },
    	'brand_id' => function() {
            return Brand::all()->random();
        },
    	'price' => $faker->numberBetween(100, 5000),
    	'stock' => $faker->randomDigit,
    	'unit' => 'kg',
    	'discount' => $faker->numberBetween(2, 30),
    	'detail' => $faker->paragraph
    ];
});
