<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Guest::class, function (Faker $faker) {
    return [
        'IP' => $faker->ipv4
    ];
});
