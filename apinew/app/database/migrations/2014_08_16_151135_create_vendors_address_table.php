<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors_address', function(Blueprint $table)
		{
			$table->increments('intVendorAddressId')->unsigned();
			$table->integer('intVendorId');
			$table->string('strAddressLabel', 200);
			$table->string('strAddressLine1', 200)->nullable();
			$table->string('strAddressLine2', 200)->nullable();
			$table->string('strAddressCity', 50)->nullable();
			$table->string('strAddressState', 50)->nullable();
			$table->string('strAddressZip', 50)->nullable();
			$table->string('strAddressCountry', 50)->nullable();
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
		Schema::drop('vendors_address');
	}

}
