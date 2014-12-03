<?php

class TasksTableSeeder extends Seeder {
	public function run() {
		DB::table('tasks')->insert(array(
			array('id'=>1, 'item_id'=>1, 'name'=>'Math assignment', 'due_date'=>2014-06-02),
			array('id'=>2, 'item_id'=>1, 'name'=>'Economics assignment', 'due_date'=>2014-06-05),
			array('id'=>3, 'item_id'=>1, 'name'=>'Microproccesors assignment', 'due_date'=>2014-06-12),
			array('id'=>4, 'item_id'=>3, 'name'=>'Matchbox', 'due_date'=>2014-06-02),
			array('id'=>5, 'item_id'=>3, 'name'=>'Pen', 'due_date'=>2014-06-02),
			array('id'=>6, 'item_id'=>3, 'name'=>'Candles', 'due_date'=>2014-06-02)
			));
	}
}