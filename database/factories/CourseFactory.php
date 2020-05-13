<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {

    $title = $faker->sentence(4);

    return [
        'user_id' 		=> rand(1,30),
        'category_id' 	=> rand(1,20),
        'level_id' 	    => rand(1,3),
        'title' 		=> $title,
        'delivery'      => $faker->dateTimeBetween('now', '+1 years'),
        'price' 		=> $faker->numberBetween(10000,1000000),
        'excerpt' 		=> $faker->text(200),
        'body' 			=> $faker->text(500),
        'status'        => $faker->randomElement(['PUBLISHED', 'DONE','PENDING'])
    ];
});
