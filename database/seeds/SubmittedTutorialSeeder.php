<?php

use App\Models\SubmittedTutorial;
use Illuminate\Database\Seeder;

class SubmittedTutorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SubmittedTutorial::class, 25)->create();
    }
}
