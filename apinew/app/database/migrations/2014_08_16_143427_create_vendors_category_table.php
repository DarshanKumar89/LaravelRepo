<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors_category', function(Blueprint $table)
		{
			$table->increments('intVendorCategoryId')->unsigned();
			$table->string('strVendorCategoryName', 200);
			$table->string('strVendorCategoryDesc', 200)->nullable();
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
		Schema::drop('vendors_category');
	}

}
