<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFeedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Pivot table for many users to many feeds
		Schema::create('users_feeds', function(Blueprint $table){
			$table->increments('id');

			$table->integer('user_id');
			$table->integer('feed_id');
			$table->string('user_name');
			$table->string('user_email');
			$table->string('feed_name');

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
		Schema::drop('users_feeds');
	}

}
