<?php

class FotoFollowAppSeeder extends Seeder
{

	public function run()
	{
		DB::table('users')->delete();
		DB::table('feed')->delete();
		DB::table('users_feeds')->delete();

		$ivan = User::create(array(
			'name'     => 'Ivan Milosevich',
			'username' => 'Ivan.Milosevich',
			'email'    => 'Ivan.Milosevich@Colorado.edu',
			'password' => Hash::make('password'),
		));

		$brian = User::create(array(
			'name'     => 'Brian Phipps',
			'username' => 'Brian.Phipps',
			'email'    => 'Brian.Phipps@Colorado.edu',
			'password' => Hash::make('password'),
		));

		$this->command->info('Users Created');

		$puppyFeed = Feed::create(array(
			'feedName'        => 'Puppy',
			'description' => 'These are cute Puppies!',
		));

		$musicFeed = Feed::create(array(
			'feedName'        => 'Music',
			'description' => 'Anything to do with Music!',
		));

		$this->command->info('Feeds Created');

		$ivan->feeds()->attach($puppyFeed->id);
		$ivan->feeds()->attach($musicFeed->id);
		$brian->feeds()->attach($puppyFeed->id);

		$this->command->info('Users to Feeds');
	}
}