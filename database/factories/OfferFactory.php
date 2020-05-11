<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'price'   => $faker->numberBetween(25000,1000000),
        'user_id' => rand(1,100)
    ];
});
