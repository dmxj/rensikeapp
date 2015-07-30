<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			User::create([
                'name'=>'rensike'.$index,
                'email'=>'32672721'.$index."@qq.com",
                'password' => Hash::make('zhangmenglei521'.$index),
                'gender' => $index%2+1,
			]);
		}
	}

}