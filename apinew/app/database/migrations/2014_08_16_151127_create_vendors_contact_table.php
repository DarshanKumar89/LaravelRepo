<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors_contact', function(Blueprint $table)
		{
			$table->increments('intVendorContactId')->unsigned();
			$table->integer('intVendorId');
			$table->string('strContactFullName', 200);
			$table->string('strContactDesgnation', 200)->nullable();
			$table->string('strContactEmail', 50)->nullable();
			$table->string('strContactPhone1', 20)->nullable();
			$table->string('strContactPhone2', 20)->nullable();
			$table->softDeletes();
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
		Schema::drop('vendors_contact');
	}

}
