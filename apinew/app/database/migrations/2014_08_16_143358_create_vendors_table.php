<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->increments('intVendorId')->unsigned();
			$table->string('strVendorName', 200);
			$table->string('strVendorLocation', 200)->nullable();
			$table->integer('intVendorType')->nullable();
			$table->integer('intVendorCategory')->nullable();
			$table->integer('intVendorCapacity')->nullable();
			$table->string('strVendorCompliance')->nullable();
			$table->string('strVendorIECCode')->nullable();
			$table->boolean('bolVendorIsActive')->default(true);
			$table->softDeletes();
			$table->timestamps();
		});
		$sqlStatement="ALTER TABLE vendors AUTO_INCREMENT = 20000";
        DB::unprepared($sqlStatement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vendors');
	}

}
