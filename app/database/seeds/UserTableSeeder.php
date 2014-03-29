<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'name'     => 'Ivan Milosevich',
			'username' => 'Ivan.Milosevich',
			'email'    => 'Ivan.Milosevich@Colorado.edu',
			'password' => Hash::make('password'),
			'phone'    => '970-420-9057',
		));
	}
}