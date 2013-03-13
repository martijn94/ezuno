<?php

class Create_Gebruikers_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gebruikers', function($table) {
			$table->increments('id');
			$table->string('social_uid', 255);
			$table->string('social_provider', 255);
			$table->integer('studentid');
			$table->string('naam', 100);
			$table->integer('permissions');

			$table->timestamps();

			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gebruikers');
	}

}