<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Music;
use Faker\Generator as Faker;

$factory->define(Music::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 5),
        'artist' => $faker->name,
        'slug' => $faker->slug,
        'category_id' => rand(1, 5),
        'url' => 'https://www.youtube.com/watch?v=CsziEW_gYhU0/'
    ];
});
