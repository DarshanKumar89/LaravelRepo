<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chat_room', function(Blueprint $table)
		{
			$table->increments('intChatRoomId')->unsigned();
			$table->string('strRoomName',50);
			$table->integer('intRoomOwnerId');
			$table->integer('intPrivacy');
			$table->string('strTopic');
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
		Schema::drop('chat_room');
	}

}
