<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'bio' => $faker->text(60),
		'avatar' => 'https://www.gravatar.com/avatar/' . $faker->md5,
		'link' => $faker->url,
	];
});
