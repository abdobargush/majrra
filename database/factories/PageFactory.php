<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3, true),
        'slug' => $faker->unique()->slug(3, true),
        'content' => $faker->text(1000)
    ];
});
