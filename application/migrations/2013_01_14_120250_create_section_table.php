<?php

class Create_Section_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function($table) {
			$table->increments('id');
			$table->string('name', 255);

			

			});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sections');
	}

}