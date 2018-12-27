<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Cereals', 'Pulses', 'Vegetables', 'Fruits', 'Nuts', 'Oilseeds', 'Sugars and Starches', 'Fibres']),
    	'detail' => $faker->paragraph,
    ];
});
