<?php

class Create_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('email', 255);
			$table->string('password', 255);
			$table->integer('studentid');
			$table->string('name', 100);
			$table->integer('permissions');

			$table->timestamps();
		});

		DB::table('users')->insert(array(
			'email' => '0847334@hr.nl',
			'password' => Hash::make('kotskop'),
			'studentid' => '0847334',
			'name' => 'Bas van Manen',
			'permissions' => '0'
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}