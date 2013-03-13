<?php

class Create_Questions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function($table) {
			$table->increments('id');
			$table->integer('userid');
			$table->string('title', 150);
			$table->text('question');
			$table->string('tags');
			$table->integer('section');
			$table->integer('education');
			$table->integer('answered')->default('0');
			$table->integer('userid_answer');
			$table->timestamp('answered_on');







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
		Schema::drop('questions');

	}

}