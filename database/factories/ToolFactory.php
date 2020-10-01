<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tool;
use Faker\Generator as Faker;

$factory->define(Tool::class, function (Faker $faker) {

	return [
		'title' => $faker->words(rand(1,2), true),
	];

});

// Update the thumbnail separately to ignore the mutator
$factory->afterCreating(Tool::class, function (Tool $tool, Faker $faker) {
	$faker->addProvider(new \Mmo\Faker\PicsumProvider($faker));

	$tool->setRawAttributes([
		'thumbnail' => $faker->picsumUrl(86, 86)
	]);
	$tool->save();
});