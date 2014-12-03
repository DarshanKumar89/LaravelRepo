<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauth2AccesstokenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth2_accesstoken', function(Blueprint $table)
		{
			$table->increments('intAccessTokenId')->unsigned();
			$table->integer('intUserId');
			$table->string('strAccessToken',100);
			$table->string('strClientKey',50);
			// $table->integer('strClientId');
			$table->timestamp('tsmExpires');
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
		Schema::drop('oauth2_accesstoken');
	}

}
