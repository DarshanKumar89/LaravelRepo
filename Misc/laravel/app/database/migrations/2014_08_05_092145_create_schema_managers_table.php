<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaManagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('schema_managers', function($table)
       {
   
            $table->increments('id');

   $table->string('name', 255);
   $table->string('label', 255);
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
		//
			Schema::create('schema_managers', function($table)
		{
			//
			Schema::drop('schema_managers');
		});
	}

}
