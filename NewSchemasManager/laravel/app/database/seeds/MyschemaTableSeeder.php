<?php
// app/database/seeds/MyschemaTableSeeder.php

class MyschemaTableSeeder extends Seeder 
{

	public function run()
	{
		DB::table('myschemas')->delete();

		Myschema::create(array(
			'name' => 'Chris Sevilleja',
			'label' => 'Looks.',
			'data' => 'fashion.'
		));

		Myschema::create(array(
			'name' => 'Nick Cerminara',
			'label' => 'Looks crazy',
			'data'  => 'fashion designs'
		));

		Myschema::create(array(
			'name' => 'Holly Lloyd',
			'label' => 'I am a dev of Laravel and Angular.',
			'data' => 'at Sourceeasy.'
		));
	}

}
	