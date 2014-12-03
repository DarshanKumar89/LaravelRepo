<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigIncrements('intUserId')->unsigned();
			$table->string('strUserEmail', 50)->unique();
			$table->string('strUserFname', 50);
			$table->string('strUserLname', 50);
			$table->string('strUserPassword', 80);
			$table->string('strUserPasswordResetToken', 50)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->boolean('bolIsActive')->default(true);
			$table->softDeletes();
			$table->timestamps();
		});
		$sqlStatement="ALTER TABLE users AUTO_INCREMENT = 10000";
        DB::unprepared($sqlStatement);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
