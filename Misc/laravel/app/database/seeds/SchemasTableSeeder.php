<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class TweetsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			SchemaManager::create([
				'name' => $faker->sentence(10),
                'label' => $faker->sentence(10),
                'data' =>  $faker->sentence(10)

			]);
		}
	}

}
