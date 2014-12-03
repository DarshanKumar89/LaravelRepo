<?php

class ItemsTableSeeder extends Seeder {
	public function run() {
		DB::table('items')->insert(array(
			array('id'=>1, 'name'=>'Finish assignments'),
			array('id'=>2, 'name'=>'Make the business cards'),
			array('id'=>3, 'name'=>'Go to the supermarket')
			));
	}
}