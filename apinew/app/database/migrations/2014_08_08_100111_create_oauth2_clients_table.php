<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauth2ClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth2_clients', function(Blueprint $table)
		{
			$table->increments('intClientId')->unsigned();
			$table->integer('intUserId');
			$table->string('strClientKey',50);
			$table->string('strClientSecret',50);
			$table->string('strGrantType',50);
			$table->string('strRedirectUri',500);
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
		Schema::drop('oauth2_clients');
	}

}
