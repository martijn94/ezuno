<?php

class Create_Request_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request', function ($table){
		$table->increments('id');
		$table->integer('user_id');
		$table->string('title', 100);
		$table->text('detail');
		$table->string('requested_date');

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
		Schema::drop('request');
	}

}