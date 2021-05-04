<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	return [
		'title' => $faker->words(rand(1, 2), true),
		'slug' => $faker->slug,
	];
});
