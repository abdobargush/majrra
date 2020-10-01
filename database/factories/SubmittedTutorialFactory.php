<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubmittedTutorial;
use Faker\Generator as Faker;

$factory->define(SubmittedTutorial::class, function (Faker $faker) {
	return [
		'title' => $faker->text(80),
		'url' => $faker->unique()->url,
		'filters' => [
			'price' => array_rand_value(['free', 'paid']),
			'difficulty' => array_rand_value(['beginner', 'advanced']),
			'type' => array_rand_value(['video', 'audio', 'text', 'book', 'interactive'])
        ],
        'added_by' => rand(0,50)
	];
});
