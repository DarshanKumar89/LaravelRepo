<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_role', function(Blueprint $table)
		{
			$table->increments('intUserRoleId')->unsigned();
			$table->unsignedBigInteger('intUserId');
			$table->foreign('intUserId')->references('intUserId')->on('users');
			$table->unsignedInteger('intRoleId');
			$table->foreign('intRoleId')->references('intRoleId')->on('roles');
			$table->softDeletes();
			$table->timestamps();
		});
		$sqlStatement="ALTER TABLE user_role ADD CONSTRAINT intUserId_intRoleId UNIQUE (intUserId,intRoleId)";
        DB::unprepared($sqlStatement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_role');
	}

}
