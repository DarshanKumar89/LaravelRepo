<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleScopeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_scope', function(Blueprint $table)
		{
			$table->increments('intRoleScopeId')->unsigned();
			$table->unsignedInteger('intRoleId');
			$table->foreign('intRoleId')->references('intRoleId')->on('roles');
			$table->unsignedInteger('intScopeId');
			$table->foreign('intScopeId')->references('intScopeId')->on('scopes');
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
		Schema::drop('role_scope');
	}

}
