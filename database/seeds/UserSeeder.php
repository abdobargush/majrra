<?php

use App\Models\Tutorial;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(User::class, 50)->create()->each( function($user){

			$runTimes = mt_rand(0, 5);
			for ($i = 0; $i < $runTimes; $i++) {
				$user->tutorials()->save( factory(Tutorial::class)->make() );
			}

		});
	}
}
