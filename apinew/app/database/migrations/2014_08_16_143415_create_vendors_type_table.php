<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors_type', function(Blueprint $table)
		{
			$table->increments('intVendorTypeId')->unsigned();
			$table->string('strVendorTypeName', 200);
			$table->string('strVendorTypeDesc', 200)->nullable();
			$table->boolean('bolIsActive')->default(true);
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
		Schema::drop('vendors_type');
	}

}
