<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'slug' => $faker->slug,
        'subtitle' => $faker->sentence(4),
        'description' => $faker->text,
        'price' => $faker->numberBetween(5,1000),
        'image' => $faker->imageUrl($width = 640 , $height = 480 ,'technics'),
    ];
});
