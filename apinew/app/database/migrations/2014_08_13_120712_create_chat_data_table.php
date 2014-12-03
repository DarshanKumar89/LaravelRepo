<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_data', function(Blueprint $table)
		{
			$table->increments('intChatDataId')->unsigned();
			$table->integer('intChatRoomId');
			$table->integer('intFromId')->nullable();
			$table->string('strFromName',50);
			$table->string('strMessage');
			$table->string('strMessageFromat')->default('html');
			$table->integer('intNotify')->default(0);
			$table->string('intColor')->default('#eee');
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
		Schema::drop('chat_data');
	}

}
