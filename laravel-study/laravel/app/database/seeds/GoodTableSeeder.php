<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GoodTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Good::create([
               'name'=>$faker->sentence($nbWords = 6),
                'desc'=>$faker->sentence($nbWords = 100),
                'gid' => $faker->uuid(),
                'price' => $faker->randomFloat(),
                'num' => $faker->numberBetween(10,200),
			]);
		}
	}

}