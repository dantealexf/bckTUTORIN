<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Level;
use Faker\Generator as Faker;

$factory->define(Level::class, function (Faker $faker) {
    $name = $faker->sentence(4);
    return [
        'name'  => $name,
    ];
});
