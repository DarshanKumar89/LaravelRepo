<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsBaccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors_baccount', function(Blueprint $table)
		{
			$table->increments('intVendorBaccountId')->unsigned();
			$table->integer('intVendorId');
			$table->string('strBaccountBank', 200);
			$table->string('strBaccountName', 200)->nullable();
			$table->integer('intBaccountNumber')->nullable();
			$table->string('strBaccountBranch', 200)->nullable();
			$table->string('strBaccountIFSC', 200)->nullable();
			$table->string('strBaccountType', 200)->nullable();
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
		Schema::drop('vendors_baccount');
	}

}
