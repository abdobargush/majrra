<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
	return [
		'username' => $faker->unique()->userName,
		'email' => $faker->unique()->safeEmail,
		'email_verified_at' => now(),
		'password' => Hash::make('12345678'),
		'remember_token' => Str::random(10),
		'is_admin' => rand(0, 1)
	];
});

// Update profile associated with user after creating
$factory->afterCreating(User::class, function($user, $faker) {
	$user->profile()->update( factory(Profile::class)->raw() );
});
