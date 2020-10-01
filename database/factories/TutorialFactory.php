<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tutorial;
use Faker\Generator as Faker;

/**
 * Get random value from array
 *
 * @param array $array
 * @return mixed
 */
function array_rand_value($array) {
	$randKey = array_rand($array);
	return $array[$randKey];
}

$factory->define(Tutorial::class, function (Faker $faker) {
	return [
		'title' => $faker->text(80),
		'url' => $faker->unique()->url,
		'filters' => json_encode([
			'price' => array_rand_value(['free', 'paid']),
			'difficulty' => array_rand_value(['beginner', 'advanced']),
			'type' => array_rand_value(['video', 'audio', 'text', 'book', 'interactive'])
		]),
	];
});
