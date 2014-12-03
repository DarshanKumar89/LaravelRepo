<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scopes', function(Blueprint $table)
		{
			$table->increments('intScopeId')->unsigned();
			$table->string('strScopeName', 50);
			$table->string('strScopeDesc', 200);
			$table->integer('intScopePerm')->default(0);
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
		Schema::drop('scopes');
	}

}
