<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $title = $faker->sentence(4);

    return [
        'user_id' 		=> rand(1,80),
        'category_id' 	=> rand(1,40),
        'level_id' 	    => rand(1,3),
        'title' 		=> $title,
        'delivery'      => $faker->dateTimeBetween('now', '+1 years'),
        'price' 		=> $faker->numberBetween(10000,1000000),
        'body' 			=> $faker->text(500),
        'status'        => $faker->randomElement(['PUBLISHED', 'DONE','PENDING'])
    ];
});
