<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Brand::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    	'detail' => $faker->paragraph
    ];
});
