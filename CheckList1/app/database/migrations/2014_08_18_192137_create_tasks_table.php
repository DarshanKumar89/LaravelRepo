<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function($table) {
			$table->increments('id');
			$table->integer('item_id');
			$table->string('name');
			$table->date('due_date')->nullable();
			$table->boolean('done');			
			$table->timestamps();
			$table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE')->onUpdate('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	Schema::drop('tasks');
	}

}
