<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement([
            'Pop', 'Bachata', 'Salsa', 'Rock', 'PodCast'
            ]),
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ];
});
