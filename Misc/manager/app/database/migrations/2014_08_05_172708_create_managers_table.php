<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('managers', function($table)
		{
			//
			  $table->increments('id');

			   $table->string('name', 25);
			   $table->string('label', 25);
			   $table->text('data');
			   
			   $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('managers', function($table)
		{
			//
			Schema::drop('managers');
		});
	}

}
